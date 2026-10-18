"""Kết nối SSH/SFTP tới server + chạy MySQL an toàn (mật khẩu qua file cnf chmod 600)."""
from __future__ import annotations

import posixpath
import shlex
import uuid

import paramiko

from config import load_sftp_config, parse_env, remote_root


class Remote:
    def __init__(self) -> None:
        cfg = load_sftp_config()
        self.client = paramiko.SSHClient()
        self.client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
        self.client.connect(
            cfg["host"], port=cfg.get("port", 22), username=cfg["username"],
            password=cfg["password"], timeout=30,
        )
        self.sftp = self.client.open_sftp()
        self.root = remote_root()
        self._db: dict | None = None
        self._cnf: str | None = None

    # ---------- shell ----------
    def run(self, cmd: str, check: bool = True, timeout: int = 300) -> str:
        _, out, err = self.client.exec_command(cmd, timeout=timeout)
        code = out.channel.recv_exit_status()
        o = out.read().decode("utf-8", "ignore")
        e = err.read().decode("utf-8", "ignore")
        if check and code != 0:
            raise RuntimeError(f"Remote command failed ({code}): {e.strip() or o.strip()}")
        return o

    # ---------- files ----------
    def upload(self, local: str, remote: str) -> None:
        self.sftp.put(local, remote)

    def download(self, remote: str, local: str) -> None:
        self.sftp.get(remote, local)

    def read_text(self, remote: str) -> str:
        with self.sftp.open(remote, "r") as f:
            return f.read().decode("utf-8", "ignore")

    def remove(self, remote: str) -> None:
        try:
            self.sftp.remove(remote)
        except IOError:
            pass

    def exists(self, remote: str) -> bool:
        try:
            self.sftp.stat(remote)
            return True
        except IOError:
            return False

    # ---------- database ----------
    @property
    def db(self) -> dict:
        if self._db is None:
            env = parse_env(self.read_text(posixpath.join(self.root, ".env")))
            self._db = {
                "host": env.get("DB_HOST", "localhost"),
                "port": env.get("DB_PORT", "3306"),
                "name": env["DB_DATABASE"],
                "user": env["DB_USERNAME"],
                "password": env["DB_PASSWORD"],
            }
        return self._db

    def _cnf_path(self) -> str:
        if self._cnf is None:
            home = self.run("echo $HOME").strip()
            self._cnf = f"{home}/.blogtool_{uuid.uuid4().hex[:8]}.cnf"
            pw = self.db["password"].replace("\\", "\\\\").replace('"', '\\"')
            content = (
                "[client]\n"
                f"user=\"{self.db['user']}\"\n"
                f"password=\"{pw}\"\n"
                f"host=\"{self.db['host']}\"\n"
                f"port={self.db['port']}\n"
                "default-character-set=utf8mb4\n"
            )
            with self.sftp.open(self._cnf, "w") as f:
                f.write(content)
            self.sftp.chmod(self._cnf, 0o600)
        return self._cnf

    def mysql_query(self, sql: str) -> list[list[str]]:
        """Chạy 1 câu SELECT, trả về list các dòng (tab-separated, không header)."""
        cmd = (
            f"mysql --defaults-extra-file={shlex.quote(self._cnf_path())} -r -N -B "
            f"{shlex.quote(self.db['name'])} -e {shlex.quote(sql)}"
        )
        out = self.run(cmd)
        return [line.split("\t") for line in out.splitlines() if line.strip()]

    def mysql_file(self, local_sql: str) -> str:
        """Upload file SQL và chạy. Lỗi giữa chừng => mysql dừng, transaction tự rollback."""
        home = self.run("echo $HOME").strip()
        remote_sql = f"{home}/.blogtool_{uuid.uuid4().hex[:8]}.sql"
        self.upload(local_sql, remote_sql)
        try:
            cmd = (
                f"mysql --defaults-extra-file={shlex.quote(self._cnf_path())} "
                f"{shlex.quote(self.db['name'])} < {shlex.quote(remote_sql)}"
            )
            return self.run(cmd)
        finally:
            self.remove(remote_sql)

    def mysqldump(self, tables: list[str], local_out: str) -> None:
        home = self.run("echo $HOME").strip()
        remote_out = f"{home}/.blogtool_backup_{uuid.uuid4().hex[:8]}.sql.gz"
        try:
            cmd = (
                f"mysqldump --defaults-extra-file={shlex.quote(self._cnf_path())} "
                f"--single-transaction --no-tablespaces {shlex.quote(self.db['name'])} "
                + " ".join(shlex.quote(t) for t in tables)
                + f" | gzip > {shlex.quote(remote_out)}"
            )
            self.run(cmd, timeout=600)
            self.download(remote_out, local_out)
        finally:
            self.remove(remote_out)

    def artisan(self, args: str) -> str:
        return self.run(f"cd {shlex.quote(self.root)} && php artisan {args}", check=False)

    def close(self) -> None:
        if self._cnf:
            self.remove(self._cnf)
        self.sftp.close()
        self.client.close()

    def __enter__(self) -> "Remote":
        return self

    def __exit__(self, *exc) -> None:
        self.close()
