<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Magic;
use app\model\LoginModel;
use app\base\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $model = new LoginModel();



        if ($request->isGet()){
            $this->view('login', ['model'=>$model]);
        }else{
            $model->load($request->getBody());

            if ($model->validate() && $model->save()){
                Magic::dd('uraaa');
            }

            $this->view('login', ['model'=>$model]);
        }
    }

}