<?php

namespace App\config;

use PDO;
use function PHPUnit\Framework\exactly;

require_once __DIR__ . '/../../config.php';

/**
 *
 */
class database
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @return PDO|null
     */
    public static function getInstance()
    {

        if (self::$instance === null) {
            $dsn = $_ENV['DB_CONNECTION'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'] . ';port=' . $_ENV['DB_PORT'];
            self::$instance = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}