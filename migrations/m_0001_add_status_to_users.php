<?php

use app\base\Migration;

class m_0001_add_status_to_users extends Migration
{

    public function up()
    {
        $this->query("alter table users add status enum('0','9','10')");
    }
}