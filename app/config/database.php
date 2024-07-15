<?php

namespace App\config;

use PDO;

class database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = getenv('DB_CONNECTION') . ':host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE') . ';port=' . getenv('DB_PORT');
            self::$instance = new PDO($dsn, getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}