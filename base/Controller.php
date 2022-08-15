<?php

namespace app\base;

class Controller
{
    public $layout= "main";
    public array $middlewares = [];
    public string $action = '';

    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


    public function view($view, $data =[])
    {
       echo Fire::$fire->router->view($view, $data);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}