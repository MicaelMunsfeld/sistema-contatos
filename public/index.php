<?php

require_once __DIR__ . '/../config/bootstrap.php';

use App\Controller\PessoaController, App\Controller\ContatoController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/magazord-teste/public', '', $uri);
$path = $path === '' ? '/' : $path;
$path = rtrim($path, '/') ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

$pessoaController  = new PessoaController($entityManager);
$contatoController = new ContatoController($entityManager);

if(str_starts_with($path, '/pessoas') || $path === '/') {
    rotaPessoas($path, $method, $pessoaController);
}elseif(str_starts_with($path, '/contatos')) {
    rotaContatos($path, $method, $contatoController);
}else{
    http_response_code(404);
    echo 'Página não encontrada: ' . htmlspecialchars($path);
}

/**
 * Função para propagar as requisições relacionadas a pessoas.
 *
 * @param string $path O caminho da requisição.
 * @param string $method O método HTTP da requisição.
 * @param PessoaController $controller O controlador de pessoas.
 */
function rotaPessoas(string $path, string $method, PessoaController $controller): void {
    if($path === '/' || $path === '/pessoas') {
        $controller->index();
        return;
    }
    if($path === '/pessoas/criar' && $method === 'GET') {
        $controller->create();
        return;
    }
    if($path === '/pessoas/salvar' && $method === 'POST') {
        $controller->store();
        return;
    }
    if($path === '/pessoas/atualizar' && $method === 'POST') {
        $controller->update();
        return;
    }
    if(preg_match('#^/pessoas/editar/(\d+)$#', $path, $m) && $method === 'GET') {
        $controller->edit((int) $m[1]);
        return;
    }
    if(preg_match('#^/pessoas/excluir/(\d+)$#', $path, $m)) {
        $controller->delete((int) $m[1]);
        return;
    }
    if(preg_match('#^/pessoas/(\d+)$#', $path, $m)) {
        $controller->show((int) $m[1]);
        return;
    }
    http_response_code(404);
    echo 'Página não encontrada: ' . htmlspecialchars($path);
}

/**
 * Função para propagar as requisições relacionadas aos contatos.
 *
 * @param string $path O caminho da requisição.
 * @param string $method O método HTTP da requisição.
 * @param ContatoController $controller O controlador de contatos.
 */
function rotaContatos(string $path, string $method, ContatoController $controller): void {
    if($path === '/contatos') {
        $controller->index();
        return;
    }
    if($path === '/contatos/criar' && $method === 'GET') {
        $controller->create();
        return;
    }
    if($path === '/contatos/salvar' && $method === 'POST') {
        $controller->store();
        return;
    }
    if($path === '/contatos/atualizar' && $method === 'POST') {
        $controller->update();
        return;
    }
    if(preg_match('#^/contatos/editar/(\d+)$#', $path, $m) && $method === 'GET') {
        $controller->edit((int) $m[1]);
        return;
    }
    if(preg_match('#^/contatos/excluir/(\d+)$#', $path, $m)) {
        $controller->delete((int) $m[1]);
        return;
    }
    if(preg_match('#^/contatos/(\d+)$#', $path, $m)) {
        $controller->show((int) $m[1]);
        return;
    }
    http_response_code(404);
    echo 'Página não encontrada: ' . htmlspecialchars($path);
}