<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contato #<?= $contato->getId() ?></title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        .btn{display:inline-block;padding:8px 14px;background:#0066cc;color:#fff;text-decoration:none;border-radius:4px;margin-right:8px}
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <h1>Contato</h1>
    <p><strong>ID:</strong> <?= $contato->getId() ?></p>
    <p><strong>Tipo:</strong> <?= htmlspecialchars($contato->getTipo()) ?></p>
    <p><strong>Descrição:</strong> <?= htmlspecialchars($contato->getDescricao()) ?></p>
    <p><strong>Pessoa:</strong> <?= htmlspecialchars($contato->getPessoa()->getNome()) ?></p>
    <p style="margin-top:20px">
        <a class="btn" href="/magazord-teste/public/contatos/editar/<?= $contato->getId() ?>">Editar</a>
        <a class="btn" href="/magazord-teste/public/contatos">Voltar</a>
    </p>
</div>
</body>
</html>