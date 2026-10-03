<?php
$titulo = 'Pessoas';
$view = __FILE__;
ob_start();
?>
<h1>Pessoas</h1>

<form class="search" method="GET" action="/magazord-teste/public/pessoas">
    <input type="text" name="busca" placeholder="Pesquisar por nome..." value="<?= htmlspecialchars($busca ?? '') ?>">
    <button class="btn" type="submit">Pesquisar</button>
    <?php if (!empty($busca)): ?>
        <a class="btn btn-secondary" href="/magazord-teste/public/pessoas">Limpar</a>
    <?php endif; ?>
</form>

<p><a class="btn" href="/magazord-teste/public/pessoas/criar">Nova Pessoa</a></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($pessoas)): ?>
        <tr><td colspan="4">Nenhuma pessoa encontrada.</td></tr>
    <?php else: ?>
        <?php foreach ($pessoas as $pessoa): ?>
            <tr>
                <td><?= $pessoa->getId() ?></td>
                <td><?= htmlspecialchars($pessoa->getNome()) ?></td>
                <td><?= htmlspecialchars($pessoa->getCpf()) ?></td>
                <td class="actions">
                    <a href="/magazord-teste/public/pessoas/<?= $pessoa->getId() ?>">Ver</a>
                    <a href="/magazord-teste/public/pessoas/editar/<?= $pessoa->getId() ?>">Editar</a>
                    <a href="/magazord-teste/public/pessoas/excluir/<?= $pessoa->getId() ?>" onclick="return confirm('Excluir esta pessoa?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
// layout simples inline para evitar complexidade
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pessoas</title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:900px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        table{width:100%;border-collapse:collapse;margin-top:15px}
        th,td{border:1px solid #ddd;padding:10px;text-align:left}
        th{background:#f0f0f0}
        .btn{display:inline-block;padding:8px 14px;background:#0066cc;color:#fff;text-decoration:none;border-radius:4px;border:none;cursor:pointer}
        .btn-secondary{background:#666}
        .search{display:flex;gap:8px;margin:15px 0}
        .search input{flex:1;padding:8px}
        .actions a{margin-right:8px}
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <?= $content ?>
</div>
</body>
</html>