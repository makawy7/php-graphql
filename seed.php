<?php

use App\DataFixtures\DatabaseSeeder;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Loader;
use App\AppContext;

require_once __DIR__ . '/vendor/autoload.php';

$entityManager = (new AppContext())->entityManager;

$loader = new Loader();
$loader->addFixture(new DatabaseSeeder());

$executor = new ORMExecutor($entityManager, new ORMPurger());
$executor->execute($loader->getFixtures());
