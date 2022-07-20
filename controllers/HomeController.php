<?php

namespace app\controllers;

use app\base\Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo "post controller";
    }

    public function contact()
    {
        $this->setLayout('_blanc');
        $this->view('home',['model'=>[1,2,3,4,5,6]]);
    }



}