<?php

namespace app\base;

class Magic
{
    public static function dd($data, $mode=false)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if ($mode){
            exit();
        }
    }
}