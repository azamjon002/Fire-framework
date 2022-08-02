<?php

namespace app\model;

use app\base\Magic;
use app\base\Model;

class RegisterModel extends Model
{

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';


    function rules()
    {
        return[
            'firstname'=>[self::RULE_REQUIRED],
            'lastname'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED, [self::RULE_MIN=>8],[self::RULE_MAX=>15]],
            'confirm_password'=>[self::RULE_REQUIRED, [self::RULE_EQUAL=>'password']]
        ];

    }



}