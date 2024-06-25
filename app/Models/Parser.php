<?php

namespace App\Models;

use App\Database\Connector;
use PDO;


class Parser {

    public static function getAll()
    {
       $query = "SELECT * FROM coins";
        return Connector::instance()->query($query)->fetchAll();
    }

    public static function getAllByFilter($queryParams, $sqlFilter)
    {
        $query = "SELECT * FROM coins WHERE ".$sqlFilter;
        $sth = Connector::instance()->prepare($query);
        $sth->execute($queryParams);
        return $sth->fetchAll();
    }

    public static function store($queryParamsInsert, $sqlFilterInsert)
    {
        $query = "INSERT INTO coins SET ".$sqlFilterInsert;
        $sth = Connector::instance()->prepare($query);
        $sth->execute($queryParamsInsert);
    }

    public static function isExists($queryParams, $sqlFilter)
    {
        $query = "SELECT * FROM coins WHERE ".$sqlFilter;
        $sth = Connector::instance()->prepare($query);
        $sth->execute($queryParams);
        return count($sth->fetchAll());
    }


}