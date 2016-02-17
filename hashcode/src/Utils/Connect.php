<?php namespace Utils;

class Connect
{

    public static $pdo = null;

    public static function set($database, $defaults=[])
    {
        try {
            self::$pdo = new \PDO($database['dsn'], $database['user'], $database['password'], $defaults);
        } catch (PDOException $e) {

            throw new \RuntimeException(sprintf('fail connection database %s', $database['dsn']));

        }
    }

}