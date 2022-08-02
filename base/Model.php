<?php

namespace app\base;

abstract class Model
{
    public array $errors = [];
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_EQUAL = 'equal';


    public function load(array $getBody)
    {
        foreach ($getBody as $attribute => $value) {
            if (property_exists($this, $attribute)){
                $this->{$attribute} = $value;
            }
        }
    }

    abstract function rules();


    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)){
                    $ruleName = key($rule);
                }

                if ($ruleName == self::RULE_REQUIRED && !$value){
                    $this->errors[$attribute][]="Malumot to'liq kiritilishi kerak";
                }

                if ($ruleName == self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->errors[$attribute][]="Email xato kiritildi";
                }

                if ($ruleName == self::RULE_MIN && strlen($value) < $rule[self::RULE_MIN]){
                    $this->errors[$attribute][]="Ma'lumot ".$rule[self::RULE_MIN]." tadan kam bo'lmasligi kerak";
                }

                if ($ruleName == self::RULE_MAX && strlen($value) > $rule[self::RULE_MAX]){
                    $this->errors[$attribute][]="Ma'lumot ".$rule[self::RULE_MAX]." tadan ko'p bo'lmasligi kerak";
                }

                if ($ruleName == self::RULE_EQUAL && $value != $this->{$rule[self::RULE_EQUAL]}){
                    $this->errors[$attribute][]="Ma'lumot ".$rule[self::RULE_EQUAL]." bilan bir xil bo'ishi kerak";
                }
            }
        }
        return empty($this->errors);
    }

    public function save()
    {
        return true;
    }

    public function hasErrors($attribute)
    {
        return $this->errors[$attribute]??false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0]??false;
    }


}