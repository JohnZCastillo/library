<?php

namespace model;

class Database
{

    private static $serverName = "localhost";
    private static $userName = "root";
    private static $password = "";
    private static $database = "library";

    public static function open()
    {

        $connection = mysqli_connect(
            self::$serverName,
            self::$userName,
            self::$password,
            self::$database
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