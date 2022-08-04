<?php

namespace app\controllers;

use app\base\Controller;
use app\base\Fire;
use app\base\Magic;
use app\base\Request;
use app\base\Response;
use app\model\RegisterModel;

class RegisterController extends Controller
{

    public function register(Request $request, Response $response)
    {
        $model = new RegisterModel();



        if ($request->isGet()){
            $this->view('register', ['model'=>$model]);
        }else{
            $model->load($request->getBody());

            if ($model->validate() && $model->save()){

                Fire::$fire->session->setFlash('info', 'Siz muvaffaqiyatli ro\'yhatdan o\'tdingiz');
                $response->redirect('login');
            }

            $this->view('register', ['model'=>$model]);
        }
    }

}