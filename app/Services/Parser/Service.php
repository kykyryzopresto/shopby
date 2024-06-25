<?php

namespace App\Services\Parser;

class Service
{
    public static function prepareFilters($queryParams,$delimeter = ", ")
    {
        return implode($delimeter,array_map(function($val){
            return $val." = ? ";
        },array_keys($queryParams)));
    }
}