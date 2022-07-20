<?php

namespace app\base;

class Fire
{
    public Request $request;
    public Router $router;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function test(){
        echo  "autoload ulandi";
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}