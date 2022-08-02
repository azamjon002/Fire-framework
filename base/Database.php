<?php

namespace app\base;

class Database
{

    private $conn;


    public function __construct($config)
    {
        $host=$config['host'];
        $user=$config['user'];
        $password=$config['password'];
        $baza=$config['database'];

        $this->conn=mysqli_connect($host, $user,$password, $baza);
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function create_migration_table()
    {
        $this->query("create table if not exists migrations (
                            id int auto_increment primary key,
                            migration varchar(255),
                            created_at timestamp default current_timestamp
                        )");
    }

    public function folder()
    {
        $folder =  scandir('migrations');
        unset($folder[0]);
        unset($folder[1]);
        return $folder;
    }

    public function run()
    {
        $this->create_migration_table();

        $folder = $this->folder();
        $bazadagi_migrations = $this->get_migrations_from_baza();

        $diff_migrations = array_diff($folder, $bazadagi_migrations);

        if (count($diff_migrations)==0){
            echo "Migrationlar allaqachon yozib bo'lingan";
            echo "\n";
        }else{
            foreach ($folder as $item) {
                $migration_name = pathinfo($item, PATHINFO_FILENAME);
                $classname = include "migrations/$item";
                $migration_class = new $migration_name();

                echo "$item yozilmoqda...  ".date('Y-m-d H:i:s').PHP_EOL;
                $migration_class->up();
                echo "$item yozildi!  ".date('Y-m-d H:i:s').PHP_EOL;

                $this->query("insert into migrations (migration) values ('$item')");
            }
        }

    }

    public function get_migrations_from_baza()
    {
        $massiv=[];
        $data = $this->query("select migration from migrations")->fetch_all();

        foreach ($data as $datum) {
            $massiv[]=$datum[0];
        }
        return $massiv;
    }



}