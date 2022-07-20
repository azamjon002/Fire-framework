<?php

use app\controllers\HomeController;

ini_set('display_errors',1);

require_once '../vendor/autoload.php';


$fire = new \app\base\Fire();

$fire->router->get('/', function (){
   echo "callback ishga tushdi";
});

$fire->router->get('/view', 'home');

$fire->router->get('/contact', function (){
    echo  "contact";
});

$fire->router->post('test', [HomeController::class, 'index']);

$fire->run();