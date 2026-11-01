from pathlib import Path

replacements = [
    (
        "'COALESCE(SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE -quantity END), 0)'",
        '"COALESCE(SUM(CASE WHEN type = \'Masuk\' THEN quantity ELSE -quantity END), 0)"',
    ),
    (
        "'COALESCE(SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE -quantity END), 0) as stock'",
        '"COALESCE(SUM(CASE WHEN type = \'Masuk\' THEN quantity ELSE -quantity END), 0) as stock"',
    ),
    (
        "'COALESCE(SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE -quantity END), 0) as total_stock'",
        '"COALESCE(SUM(CASE WHEN type = \'Masuk\' THEN quantity ELSE -quantity END), 0) as total_stock"',
    ),
    (
        "'product_id, COALESCE(SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE -quantity END), 0) as stock'",
        '"product_id, COALESCE(SUM(CASE WHEN type = \'Masuk\' THEN quantity ELSE -quantity END), 0) as stock"',
    ),
    (
        "'COALESCE(SUM(CASE WHEN type = 'Masuk' THEN quantity ELSE -quantity END), 0) > 0'",
        '"COALESCE(SUM(CASE WHEN type = \'Masuk\' THEN quantity ELSE -quantity END), 0) > 0"',
    ),
    (
        "'COALESCE(SUM(CASE WHEN stock_transactions.type = 'Masuk' THEN stock_transactions.quantity ELSE -stock_transactions.quantity END), 0) as current_stock'",
        '"COALESCE(SUM(CASE WHEN stock_transactions.type = \'Masuk\' THEN stock_transactions.quantity ELSE -stock_transactions.quantity END), 0) as current_stock"',
    ),
]

files = [
    Path(r"c:\Users\Toshiba\gloriouss\app\Http\Controllers\Main\ProductsController.php"),
    Path(r"c:\Users\Toshiba\gloriouss\app\Http\Controllers\Main\DashboardsController.php"),
    Path(r"c:\Users\Toshiba\gloriouss\test_stock_sync.php"),
]

for path in files:
    text = path.read_text(encoding="utf-8")
    original = text
    for old, new in replacements:
        text = text.replace(old, new)
    if text != original:
        path.write_text(text, encoding="utf-8")
        print("updated", path.name)
    else:
        print("unchanged", path.name)
