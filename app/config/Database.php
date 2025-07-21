<?php

namespace app\config;

use PDO;

class Database
{
    private array $dataConfig;

    public function __construct()
    {
        $this->dataConfig = [
            'driver'    => $_ENV['DB_DRIVER']   ?? 'mysql',
            'host'      => $_ENV['DB_HOST']     ?? 'localhost',
            'port'      => $_ENV['DB_PORT']     ?? '3306',
            'database'  => $_ENV['DB_DATABASE'] ?? '',
            'username'  => $_ENV['DB_USER']     ?? '',
            'password'  => $_ENV['DB_PASS']     ?? '',
            'options'   => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $_ENV['DB_CHARSET']  ?? 'utf8mb4'
            ]
        ];
    }


    public static function config()
    {
        static $config = new Database();
        return $config;
    }


    public function get($key)
    {
        return $this->dataConfig[$key];
    }
}
