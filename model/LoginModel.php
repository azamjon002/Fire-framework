<?php

namespace app\model;

use app\base\Model;

class LoginModel extends Model
{

    public string $email = '';
    public string $password = '';

    function rules()
    {
        return [
            'email'=>[self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED, [self::RULE_MIN=>8],[self::RULE_MAX=>15]],
        ];

    }

}