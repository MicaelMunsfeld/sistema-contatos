<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner, Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once __DIR__ . '/../config/bootstrap.php';

ConsoleRunner::run(new SingleManagerProvider($entityManager));