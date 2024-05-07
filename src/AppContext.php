<?php

namespace App;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class AppContext
{
    public $entityManager;

    public function __construct()
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__ . '/Entities'),
            isDevMode: true
        );

        $connection = DriverManager::getConnection([
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER']
        ]);

        $this->entityManager = new EntityManager($connection, $config);
    }
}
