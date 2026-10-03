<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Sistema de Contatos' ?></title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; }
        nav { margin-bottom: 20px; }
        nav a { margin-right: 15px; text-decoration: none; color: #333; font-weight: bold; }
        nav a:hover { color: #0066cc; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f0f0f0; }
        .btn { display: inline-block; padding: 8px 14px; background: #0066cc; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-danger { background: #cc0000; }
        .btn-secondary { background: #666; }
        form { margin-top: 15px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 4px; }
        .actions a { margin-right: 8px; }
        .search { margin: 15px 0; display: flex; gap: 8px; }
        .search input { flex: 1; }
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <?php require $view; ?>
</div>
</body>
</html>