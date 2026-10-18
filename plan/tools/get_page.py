import json
from ssh_client import Remote
with Remote() as r:
    out = r.artisan("tinker --execute=\"echo json_encode(DB::table('pages')->where('id', 15)->first());\"")
    print(out)
