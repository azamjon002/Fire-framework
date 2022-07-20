<?php

use app\controllers\HomeController;
ini_set('display_errors',1);
require_once '../vendor/autoload.php';
$fire = new \app\base\Fire();




$fire->router->get('/', 'welcome');
$fire->router->get('/test', [HomeController::class, 'index']);
$fire->router->get('/test2', [HomeController::class, 'contact']);


$fire->router->get('/register', [\app\controllers\RegisterController::class, 'register']);
$fire->router->post('/register', [\app\controllers\RegisterController::class, 'register']);

$fire->run();