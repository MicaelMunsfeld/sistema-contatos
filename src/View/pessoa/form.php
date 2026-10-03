<?php
$isEdit = isset($pessoa) && $pessoa->getId();
$action = $isEdit ? '/magazord-teste/public/pessoas/atualizar' : '/magazord-teste/public/pessoas/salvar';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Editar' : 'Nova' ?> Pessoa</title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        label{display:block;margin-top:12px;font-weight:bold}
        input{width:100%;padding:8px;margin-top:4px}
        .btn{margin-top:15px;padding:8px 14px;background:#0066cc;color:#fff;border:none;border-radius:4px;cursor:pointer}
        a.btn-secondary{background:#666;text-decoration:none;padding:8px 14px;display:inline-block;margin-left:8px;border-radius:4px;color:#fff}
    </style>
</head>
<body>
<div class="container">
    <nav>
        <a href="/magazord-teste/public/pessoas">Pessoas</a>
        <a href="/magazord-teste/public/contatos">Contatos</a>
    </nav>
    <h1><?= $isEdit ? 'Editar Pessoa' : 'Nova Pessoa' ?></h1>
    <form method="POST" action="<?= $action ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">
        <?php endif; ?>
        <label>Nome</label>
        <input type="text" name="nome" required value="<?= $isEdit ? htmlspecialchars($pessoa->getNome()) : '' ?>">
        <label>CPF</label>
        <input type="text" name="cpf" required maxlength="14" value="<?= $isEdit ? htmlspecialchars($pessoa->getCpf()) : '' ?>">
        <button class="btn" type="submit">Salvar</button>
        <a class="btn-secondary" href="/magazord-teste/public/pessoas">Cancelar</a>
    </form>
</div>
</body>
</html>