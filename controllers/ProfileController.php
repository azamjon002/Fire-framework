<?php

namespace app\controllers;

use app\base\AuthMiddleware;
use app\base\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function index()
    {
        $this->view('profile');
    }


}