<?php

namespace App\Db;

class Database
{

    private static $serverName;
    private static $userName;
    private static $password;
    private static $database;

    public static function open()
    {

        $connection = mysqli_connect(
            self::$serverName,
            self::$userName,
            self::$password,
            self::$password
        );

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    public static function close($connection)
    {
        $connection->close();
    }
}