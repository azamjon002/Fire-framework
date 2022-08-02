<?php

namespace app\base;

abstract class Migration
{
    public abstract function up();

    public function query($sql)
    {
        return Fire::$fire->db->query($sql);
    }
}