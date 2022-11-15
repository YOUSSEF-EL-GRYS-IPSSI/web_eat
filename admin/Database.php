<?php

class Database
{

    private static $dbHost = "localhost";
    private static $dbName = "web_eat";
    private static $dbUser = "root";
    private static $userPassword = "";

    private static $connection = null;



    public static function connect()
    {

        try {

            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$userPassword);
        } catch (PDOException $e) {

            die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}



?>