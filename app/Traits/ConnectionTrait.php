<?php

use Medoo\Medoo;

trait ConnectionTrait
{
    public function do_connect()
    {
        return new Medoo([
            // required
            'database_type' => getenv('DB_CONNECTION'),
            'database_name' => getenv('DB_DATABASE'),
            'server' => getenv('DB_HOST'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),

            // [optional]
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci',
            'port' => getenv('DB_PORT'),

            // [optional] driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option' => [
                PDO::ATTR_CASE => PDO::CASE_NATURAL
            ],
        ]);
    }
}
