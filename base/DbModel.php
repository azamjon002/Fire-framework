<?php

namespace app\base;

abstract class DbModel extends  Model
{

    public function query($sql)
    {
        return Fire::$fire->db->query($sql);
    }

    public function find(array $where)
    {
        $table = $this->tablename();

        $str = '';
        $and = ' and ';
        foreach ($where as $key=>$item) {
            $str.= "$key = '$item' $and";
        }
        $wheres = substr($str, 0, -4);

        $sql = "select * from $table where $wheres";

        if($this->query($sql)->num_rows == 0){
            return false;
        }else{
            return mysqli_fetch_object($this->query($sql), static::class);
        }
    }

    //Object Relational Map
    public function save()
    {
        $table = $this->tablename();
        $attributes = $this->attributes();

        $attributes_str = implode(',', $attributes);
        $values = [];

        foreach ($attributes as $attribute) {
            $values[]=$this->{$attribute};
        }

        $values = array_map(function ($item){return "'$item'";}, $values);
        $values_str = implode(',', $values);


        $sql = "insert into $table ($attributes_str) values($values_str)";

        $test = $this->query($sql);
        if (!$test){
            return false;
        }
        return true;
    }

    abstract function tablename();
    abstract function attributes();
}