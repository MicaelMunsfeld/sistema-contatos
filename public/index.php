<?php

require_once __DIR__ . '/../config/bootstrap.php';

use App\Controller\PessoaController, App\Controller\ContatoController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = '/magazord-teste/public'; // ajuste se a pasta local tiver outro nome
$path = str_replace($base, '', $uri);
$path = $path === '' ? '/' : $path;
$method = $_SERVER['REQUEST_METHOD'];

$pessoaController = new PessoaController($entityManager);
$contatoController = new ContatoController($entityManager);

match (true) {
    
    $path === '/' || $path === '/pessoas' => $pessoaController->index(),
    $path === '/pessoas/criar' && $method === 'GET' => $pessoaController->create(),
    $path === '/pessoas/salvar' && $method === 'POST' => $pessoaController->store(),
    preg_match('#^/pessoas/editar/(\d+)$#', $path, $m) && $method === 'GET' => $pessoaController->edit((int)$m[1]),
    $path === '/pessoas/atualizar' && $method === 'POST' => $pessoaController->update(),
    preg_match('#^/pessoas/excluir/(\d+)$#', $path, $m) => $pessoaController->delete((int)$m[1]),
    preg_match('#^/pessoas/(\d+)$#', $path, $m) => $pessoaController->show((int)$m[1]),

    $path === '/contatos' => $contatoController->index(),
    $path === '/contatos/criar' && $method === 'GET' => $contatoController->create(),
    $path === '/contatos/salvar' && $method === 'POST' => $contatoController->store(),
    preg_match('#^/contatos/editar/(\d+)$#', $path, $m) && $method === 'GET' => $contatoController->edit((int)$m[1]),
    $path === '/contatos/atualizar' && $method === 'POST' => $contatoController->update(),
    preg_match('#^/contatos/excluir/(\d+)$#', $path, $m) => $contatoController->delete((int)$m[1]),
    preg_match('#^/contatos/(\d+)$#', $path, $m) => $contatoController->show((int)$m[1]),

    default => (http_response_code(404) || true) && print 'Página não encontrada',
};