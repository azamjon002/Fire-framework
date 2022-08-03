<?php

namespace app\model;

use app\base\DbModel;
use app\base\Fire;
use app\base\Magic;
use app\base\Model;

class RegisterModel extends DbModel
{

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 9;
    const STATUS_DELETED = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';
    public int $status;

    public function save()
    {
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return parent::save();
    }

    public function rules()
    {
        return[
            'firstname'=>[self::RULE_REQUIRED],
            'lastname'=>[self::RULE_REQUIRED],
            'email'=>[self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'=>[self::RULE_REQUIRED, [self::RULE_MIN=>8],[self::RULE_MAX=>15]],
            'confirm_password'=>[self::RULE_REQUIRED, [self::RULE_EQUAL=>'password']]
        ];

    }


    public function tablename()
    {
        return 'users';
    }

    function attributes()
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password',
            'status',
        ];
    }
}