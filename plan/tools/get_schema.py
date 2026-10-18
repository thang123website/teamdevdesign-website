import json
from ssh_client import Remote
with Remote() as r:
    out = r.artisan("tinker --execute=\"echo json_encode(DB::select('SHOW COLUMNS FROM pf_services'));\"")
    print(out)
