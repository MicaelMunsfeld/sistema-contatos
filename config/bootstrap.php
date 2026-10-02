<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager, Doctrine\ORM\EntityManager, Doctrine\ORM\ORMSetup;

$paths     = [__DIR__ . '/../src/Entity']; // Caminho para as entidades do Doctrine (Caso fosse no Laravel, seria app/Models).
$isDevMode = true;
$proxyDir  = __DIR__ . '/../var/proxies';

if(!is_dir($proxyDir)) mkdir($proxyDir, 0777, true);

// Configuração do banco (XAMPP padrão)
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => '',          // Como o intuito não é esse, senha vazia no XAMPP mesmo.
    'dbname'   => 'sistema_contatos', 
];

$config = ORMSetup::createAttributeMetadataConfig($paths, $isDevMode);
$config->setProxyDir($proxyDir);
$config->setProxyNamespace('App\\Proxies');

$connection    = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);