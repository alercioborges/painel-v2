<?php

namespace core;

use app\config\Database;
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
            $config = Database::getConfig();
            self::$instance = new PDO(
                $config['driver']
                    . ":dbname=" . $config['database']
                    . ";host=" . $config['host'] . ":" . $config['port'],
                $config['username'],
                $config['password'],
                $config['options']
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

        $app = \app\config\App::getConfig();

        // Em produção, não expor detalhes do erro
        if (isset($app['env']) && $app['env'] === 'production') {
            throw new RuntimeException($message);
        }

        throw new RuntimeException($message . ': ' . $e->getMessage());
    }
}
