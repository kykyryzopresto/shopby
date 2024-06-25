<?php

namespace App\Database;

use PDO;


class Connector
{
    private static $instance;
    private static $db;

    private function __construct()
    {
        self::$db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_DATABASE.";charset=utf8", DB_USER, DB_PASSWORD);
    }

    public static function instance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function query($query)
    {
        return self::$db->query($query);
    }

    public static function prepare($query)
    {
        return self::$db->prepare($query);
    }

    public static function execute($query)
    {
        return self::$db->execute($query);
    }



    private function __clone() { }


}