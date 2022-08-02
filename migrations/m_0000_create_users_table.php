<?php

use app\base\Migration;

class m_0000_create_users_table extends Migration
{

    public function up()
    {
        $this->query("CREATE TABLE users 
                        (id int auto_increment primary key,  
                        firstname varchar(255), 
                        lastname varchar(255), 
                        email varchar(255), 
                        password varchar(255),
                        created_at timestamp default current_timestamp)");
    }
}