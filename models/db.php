<?php

class db
{
    public static function conexion(){
        $conexion = new mysqli('localhost', 'root', '19651249', 'oservices', '3306');
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}