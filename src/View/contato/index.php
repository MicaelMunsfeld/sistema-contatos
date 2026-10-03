<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:900px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        table{width:100%;border-collapse:collapse;margin-top:15px}
        th,td{border:1px solid #ddd;padding:10px;text-align:left}
        th{background:#f0f0f0}
        .btn{display:inline-block;padding:8px 14px;background:#0066cc;color:#fff;text-decoration:none;border-radius:4px}
        .actions a{margin-right:8px}
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <h1>Contatos</h1>
    <p><a class="btn" href="/magazord-teste/public/contatos/criar">Novo Contato</a></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Pessoa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($contatos)): ?>
            <tr><td colspan="5">Nenhum contato cadastrado.</td></tr>
        <?php else: ?>
            <?php foreach ($contatos as $contato): ?>
                <tr>
                    <td><?= $contato->getId() ?></td>
                    <td><?= htmlspecialchars($contato->getTipo()) ?></td>
                    <td><?= htmlspecialchars($contato->getDescricao()) ?></td>
                    <td><?= htmlspecialchars($contato->getPessoa()->getNome()) ?></td>
                    <td class="actions">
                        <a href="/magazord-teste/public/contatos/<?= $contato->getId() ?>">Ver</a>
                        <a href="/magazord-teste/public/contatos/editar/<?= $contato->getId() ?>">Editar</a>
                        <a href="/magazord-teste/public/contatos/excluir/<?= $contato->getId() ?>" onclick="return confirm('Excluir este contato?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>