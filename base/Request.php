<?php

namespace app\base;

class Request
{
    public function getUrl()
    {
        $url =  $_SERVER['REQUEST_URI'];
        $position = strpos($url, "?");

        if ($position == false){
            return $url;
        }else{
            return substr($url, 0, $position);
        }
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->getMethod() == 'get';
    }

    public function isPost()
    {
        return $this->getMethod() == 'post';
    }

    public function getBody()
    {
        $massiv = [];

        if ($this->isGet()){
            foreach ($_GET as $key => $item) {
                $massiv[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()){
            foreach ($_POST as $key => $item) {
                $massiv[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }
        return $massiv;
    }

}