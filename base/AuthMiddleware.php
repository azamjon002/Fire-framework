<?php

namespace app\base;

class AuthMiddleware extends Middleware
{
    public array $actions=[];

    public function __construct($actions)
    {
        $this->actions = $actions;
    }

    public function tekshiruv()
    {
       if (Fire::$fire->isGuest()){
           if (!empty($this->actions) || in_array(Fire::$fire->controller->action, $this->actions)){
               throw new \Exception('xato');
           }
       }
    }
}