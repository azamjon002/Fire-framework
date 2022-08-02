<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Magic;
use app\base\Request;
use app\model\RegisterModel;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $model = new RegisterModel();



        if ($request->isGet()){
            $this->view('register', ['model'=>$model]);
        }else{
            $model->load($request->getBody());

            if ($model->validate() && $model->save()){

            }

            $this->view('register', ['model'=>$model]);
        }
    }

}