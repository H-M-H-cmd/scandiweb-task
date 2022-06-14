<?php

class DB
{
    public static function connect(): PDO
    {
        $connection = new PDO("mysql:host=localhost;dbname=store", "root", "");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    }

    public static function query($query, $params = [])
    {
        $statement = self::connect()->prepare($query);
        $check = $statement->execute($params);

        if (explode(' ', $query)[0] == "SELECT") {
            return $statement->fetchAll();
        } else {
            return $check;
        }
    }
    public static  function productLastId($table):array{

        $statement =  self::connect()->query("select max(id) as last  from ".$table);
        $check = $statement->fetch();
        return $check;
    }

}




?>