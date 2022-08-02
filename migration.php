<?php

use app\base\Fire;

ini_set('display_errors',1);
require_once 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db'=>[
        'host'=>$_ENV['DB_HOST'],
        'user'=>$_ENV['DB_USER'],
        'password'=>$_ENV['DB_PASSWORD'],
        'database'=>$_ENV['DB_DATABASE']
    ]
];
$fire = new Fire($config);

$fire->db->run();
