<?php

namespace core;

use app\config\Database;
use app\config\App;
use PDO;
use PDOException;
use RuntimeException;

class Connection
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
                Database::config()->get('driver')
                    . ":dbname=" . Database::config()->get('database')
                    . ";host=" . Database::config()->get('host') . ":" . Database::config()->get('port'),
                Database::config()->get('username'),
                Database::config()->get('password'),
                Database::config()->get('options')
            );
        } catch (PDOException $e) {
            self::handleConnectionError($e);
        }
    }

    private static function handleConnectionError(PDOException $e): void
    {
        $message = "Erro de conexão com o banco de dados.";

        // Log do erro (se houver sistema de log configurado)
        if (function_exists('error_log')) {
            error_log("Database Connection Error: " . $e->getMessage());
        }

        // Em produção, não expor detalhes do erro
        if (App::config()->get('env') != NULL && App::config()->get('env') === 'production') {
            throw new RuntimeException($message);
        }

        throw new RuntimeException($message . ': ' . $e->getMessage());
    }
}
