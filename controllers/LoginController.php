<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Fire;
use app\base\Magic;
use app\base\Response;
use app\model\LoginModel;
use app\base\Request;

class LoginController extends Controller
{
    public function login(Request $request, Response $response)
    {
        $model = new LoginModel();



        if ($request->isGet()){
            $this->view('login', ['model'=>$model]);
        }else{
            $model->load($request->getBody());



            if ($model->validate() && $model->login()){
                $response->redirect('/');
            }

            $this->view('login', ['model'=>$model]);
        }
    }

    public function logout(Request $request, Response $response)
    {
        Fire::$fire->logout();

        $response->redirect('/');
    }

}