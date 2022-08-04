<?php

namespace app\base;

class Session
{
    public const FLASH_MESSAGE = 'flesh_message';
    public function __construct()
    {
        session_start();


        $flash_messages = $_SESSION[self::FLASH_MESSAGE]??[];

        foreach ($flash_messages as $key=> &$flash_message) {
            $flash_messages[$key]['remove']=true;
        }

        $_SESSION[self::FLASH_MESSAGE] = $flash_messages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_MESSAGE][$key]=[
            'remove'=>false,
            'value'=>$message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_MESSAGE][$key]['value'];
    }

    public function display($key, $color)
    {
        $message = $this->getFlash($key);
        if ($message){
            echo "<div class='alert alert-$color'>$message</div>";
        }
    }

    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key]??false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        $flash_messages = $_SESSION[self::FLASH_MESSAGE]??[];

        foreach ($flash_messages as $key=> &$flash_message) {
            if ($flash_messages[$key]['remove']){
                unset($flash_messages[$key]);
            }
        }

        $_SESSION[self::FLASH_MESSAGE] = $flash_messages;
    }
}