<?php

namespace app\base\form;

class Form
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);

        return new Form();
    }

    public function field($model, $attribute, $type='text')
    {
        return new Field($model, $attribute, $type);
    }

    public static function end()
    {
        echo "</form>";
    }

    public function button($type)
    {
        return '<button class="btn btn-info" type="'.$type.'">Submit</button>';
    }

}