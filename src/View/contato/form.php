<?php
$isEdit = isset($contato) && $contato->getId();
$action = $isEdit ? '/magazord-teste/public/contatos/atualizar' : '/magazord-teste/public/contatos/salvar';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $isEdit ? 'Editar' : 'Novo' ?> Contato</title>
    <style>
        body{font-family:Arial,sans-serif;margin:20px;background:#f5f5f5}
        .container{max-width:600px;margin:auto;background:#fff;padding:20px;border-radius:8px}
        nav a{margin-right:15px;font-weight:bold;text-decoration:none;color:#333}
        label{display:block;margin-top:12px;font-weight:bold}
        input,select{width:100%;padding:8px;margin-top:4px}
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
    <h1><?= $isEdit ? 'Editar Contato' : 'Novo Contato' ?></h1>
    <form method="POST" action="<?= $action ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $contato->getId() ?>">
        <?php endif; ?>

        <label>Pessoa</label>
        <select name="pessoa_id" required>
            <option value="">Selecione...</option>
            <?php foreach ($pessoas as $p): ?>
                <option value="<?= $p->getId() ?>"
                    <?= $isEdit && $contato->getPessoa()->getId() === $p->getId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p->getNome()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="telefone" <?= $isEdit && $contato->getTipo() === 'telefone' ? 'selected' : '' ?>>Telefone</option>
            <option value="email" <?= $isEdit && $contato->getTipo() === 'email' ? 'selected' : '' ?>>Email</option>
        </select>

        <label>Descrição</label>
        <input type="text" name="descricao" required value="<?= $isEdit ? htmlspecialchars($contato->getDescricao()) : '' ?>">

        <button class="btn" type="submit">Salvar</button>
        <a class="btn-secondary" href="/magazord-teste/public/contatos">Cancelar</a>
    </form>
</div>
</body>
</html>