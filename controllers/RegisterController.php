<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Request;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        if ($request->isGet()){
            $this->setLayout('_blanc');
            $this->view('register');
        }else{
            echo "post keldi";
        }
    }

}