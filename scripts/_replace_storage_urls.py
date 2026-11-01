import pathlib
import re

root = pathlib.Path(r"c:\Users\Toshiba\gloriouss")
pat = re.compile(r"asset\('storage/' ?\. ?(.+?)\)")
count = 0
for p in list(root.rglob("*.blade.php")) + list(root.rglob("*.php")):
    if "vendor" in p.parts or "node_modules" in p.parts or p.name.startswith("_replace"):
        continue
    text = p.read_text(encoding="utf-8")
    new, n = pat.subn(r"storage_public_url(\1)", text)
    if n:
        p.write_text(new, encoding="utf-8")
        count += n
        print(f"{n} {p.relative_to(root)}")
print("total", count)
