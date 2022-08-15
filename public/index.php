<?php

use app\base\Fire;
use app\controllers\HomeController;
//ini_set('display_errors',1);
require_once '../vendor/autoload.php';

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




$fire->router->get('/', 'welcome');
$fire->router->get('/test', [HomeController::class, 'index']);
$fire->router->get('/test2', [HomeController::class, 'contact']);


$fire->router->get('/register', [\app\controllers\RegisterController::class, 'register']);
$fire->router->post('/register', [\app\controllers\RegisterController::class, 'register']);

$fire->router->get('/login', [\app\controllers\LoginController::class, 'login']);
$fire->router->post('/login', [\app\controllers\LoginController::class, 'login']);
$fire->router->get('/logout', [\app\controllers\LoginController::class, 'logout']);
$fire->router->get('/profile', [\app\controllers\ProfileController::class, 'index']);

try {

$fire->run();
}catch (Exception $exception){
    Fire::$fire->controller->setLayout('_blanc');
    Fire::$fire->controller->view('errors/404');
}
