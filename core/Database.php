<?php

namespace core;

use app\Config;
use PDO;
use PDOException;
use RuntimeException;

class Database
{
    private static ?PDO $instance = null;

    private function __construct() {}

    private function __clone() {}

    public function __wakeup(): void
    {
        throw new RuntimeException('Cannot unserialize singleton');
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::createConnection();
        }

        return self::$instance;
    }

    private static function createConnection(): void
    {
        try {
            self::$instance = new PDO(
                Config::DB_DRIVER
                .":dbname=".Config::DB_DATABASE
                .";host=".Config::DB_HOST,
                Config::DB_USER,
                Config::DB_PASS,
                self::getDefaultOptions()
            );

        } catch (PDOException $e) { 
            self::handleConnectionError($e);
        }
    }



    private static function handleConnectionError(PDOException $e): void
    {
        $message = "Erro de conexão com o banco de dados";
        
        // Log do erro (se houver sistema de log configurado)
        if (function_exists('error_log')) {
            error_log("Database Connection Error: " . $e->getMessage());
        }
        
        // Em produção, não expor detalhes do erro
        if (defined('APP_ENV') && APP_ENV === 'production') {
            throw new RuntimeException($message);
        }
        
        throw new RuntimeException($message . ': ' . $e->getMessage());
    }


    private static function getDefaultOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . Config::DB_CHARSET
        ];
    }    

}