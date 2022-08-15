<?php

namespace app\model;

use app\base\DbModel;
use app\base\Fire;
use app\base\Magic;
use app\base\Model;

class LoginModel extends DbModel
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

    public function login()
    {
        $user= self::find(['email'=>$this->email]);
        if (!$user){
            $this->errors['email'][]="Bunday email mavjud emas!";
            return false;
        }
        if (!password_verify($this->password, $user->password)){
            $this->errors['password'][]="Parol xato kiritildi!";
        }

        return Fire::$fire->login($user);
    }

    function tablename()
    {
        return 'users';
    }

    function attributes()
    {
       return [
           'email',
           'password',
       ];
    }


}