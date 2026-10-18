import os
from ssh_client import Remote

# Replace in assets/js/main.js
assets_js = "d:\\DuAnCaNhan\\teamdevdesign\\platform\\themes\\infinia\\assets\\js\\main.js"
with open(assets_js, "r", encoding="utf-8") as f:
    content = f.read()
content = content.replace("$(window).on('load', function () {", "$(document).ready(function () {")
with open(assets_js, "w", encoding="utf-8") as f:
    f.write(content)

# Replace in public/js/main.js
public_js = "d:\\DuAnCaNhan\\teamdevdesign\\platform\\themes\\infinia\\public\\js\\main.js"
with open(public_js, "r", encoding="utf-8") as f:
    content2 = f.read()
content2 = content2.replace('e(window).on("load",(function(){', 'e(document).ready((function(){')
with open(public_js, "w", encoding="utf-8") as f:
    f.write(content2)

with Remote() as r:
    r.upload(public_js, f"{r.root}/platform/themes/infinia/public/js/main.js")
    print("Done")
