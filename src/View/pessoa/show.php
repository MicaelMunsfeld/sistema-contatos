<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pessoa #<?= $pessoa->getId() ?></title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:700px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        table{width:100%;border-collapse:collapse;margin-top:15px}
        th,td{border:1px solid #ddd;padding:10px;text-align:left}
        th{background:#f0f0f0}
        .btn{display:inline-block;padding:8px 14px;background:#0066cc;color:#fff;text-decoration:none;border-radius:4px;margin-right:8px}
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <h1>Pessoa</h1>
    <p><strong>ID:</strong> <?= $pessoa->getId() ?></p>
    <p><strong>Nome:</strong> <?= htmlspecialchars($pessoa->getNome()) ?></p>
    <p><strong>CPF:</strong> <?= htmlspecialchars($pessoa->getCpf()) ?></p>

    <h2>Contatos</h2>
    <table>
        <thead>
            <tr><th>Tipo</th><th>Descrição</th></tr>
        </thead>
        <tbody>
        <?php if ($pessoa->getContatos()->isEmpty()): ?>
            <tr><td colspan="2">Nenhum contato.</td></tr>
        <?php else: ?>
            <?php foreach ($pessoa->getContatos() as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c->getTipo()) ?></td>
                    <td><?= htmlspecialchars($c->getDescricao()) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <p style="margin-top:20px">
        <a class="btn" href="/magazord-teste/public/pessoas/editar/<?= $pessoa->getId() ?>">Editar</a>
        <a class="btn" href="/magazord-teste/public/pessoas">Voltar</a>
    </p>
</div>
</body>
</html>