<?php

namespace app\base;

class Response
{
    public function setStatusCode($code)
    {
        http_response_code('404');
    }

    public function redirect(string $string)
    {
        header("Location: ".$string);
    }
}