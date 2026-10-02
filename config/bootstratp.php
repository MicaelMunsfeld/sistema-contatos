<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager, Doctrine\ORM\EntityManager, Doctrine\ORM\ORMSetup;

$paths = [__DIR__ . '/../src/Entity']; // Caminho para as entidades do Doctrine (Caso fosse no Laravel, seria app/Models).
$isDevMode = true;

// Configuração do banco (XAMPP padrão)
$dbParams = [
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => '',          // Como o intuito não é esse, senha vazia no XAMPP mesmo.
    'dbname'   => 'magazord', 
];

$config        = ORMSetup::createAttributeMetadataConfig($paths, $isDevMode);
$connection    = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);