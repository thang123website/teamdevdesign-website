import os
from ssh_client import Remote

# Local file modification
local_request = "d:\\DuAnCaNhan\\teamdevdesign\\platform\\plugins\\portfolio\\src\\Http\\Requests\\ServiceRequest.php"
with open(local_request, "r", encoding="utf-8") as f:
    content = f.read()

# Replace required with nullable for category_id
content = content.replace(
    "'category_id' => ['required', 'exists:pf_service_categories,id']",
    "'category_id' => ['nullable']"
)

with open(local_request, "w", encoding="utf-8") as f:
    f.write(content)

with Remote() as r:
    # Upload the modified request file
    r.upload(local_request, f"{r.root}/platform/plugins/portfolio/src/Http/Requests/ServiceRequest.php")
    
    # Run DB alter
    r.artisan("tinker --execute=\"DB::statement('ALTER TABLE pf_services MODIFY category_id bigint(20) unsigned NULL;');\"")
    
    print("Database and Request updated!")
