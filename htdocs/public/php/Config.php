<?php
class Config
{
    private static $dsn = 'mysql:host=localhost;dbname=database';
    private static $user = 'root';
    private static $password = '';

    public static function getDsn()
    {
        return self::$dsn;
    }

    public static function getUser()
    {
        return self::$user;
    }

    public static function getPassword()
    {
        return self::$password;
    }
}

?>