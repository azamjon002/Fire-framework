<?php

namespace app\base;

class Controller
{
    public $layout= "main";

    public function view($view, $data =[])
    {
       echo Fire::$fire->router->view($view, $data);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}