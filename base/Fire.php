<?php

namespace app\base;

class Fire
{
    public Request $request;
    public Router $router;
    public static Fire $fire;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public Session $session;

    public function __construct($config)
    {
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->controller = new Controller();
        $this->response =new Response();
        self::$fire = $this;
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