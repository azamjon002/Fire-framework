<?php

namespace app\base;

use app\model\RegisterModel;

class Fire
{
    public Request $request;
    public Router $router;
    public static Fire $fire;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public Session $session;
    public $user;

    public function __construct($config)
    {
        $this->session = new Session();
        $this->db = new Database($config['db']);
        $this->controller = new Controller();
        $this->response =new Response();
        self::$fire = $this;
        $this->request = new Request();
        $this->router = new Router($this->request);

        $id = $this->session->get('user');
        if ($id){
            $userModal = new RegisterModel();
            $user = $userModal->find(['id'=>$id]);
            $this->user =$user;
        }else{
            $this->user = null;
        }

    }

    public function test(){
        echo  "autoload ulandi";
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login($user)
    {
        $this->user=$user;
        $this->session->set('user', $user->id);
        return true;
    }

    public function logout()
    {
        $this->session->remove('user');
        $this->user = null;
    }

    public function isGuest()
    {
        return !$this->user;
    }

    public function getDisplayName()
    {
        return $this->user->firstname;
    }

}