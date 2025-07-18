<?php

namespace app\config;

class App
{
    public static function getConfig(): array
    {
        return [
            'env' => $_ENV['APP_NODE_ENV'] ?? 'production',
            'debug' => ($_ENV['APP_DEBUG'] ?? 'false') === 'true',
            'dir' => $_ENV['APP_BASE_DIR'] ??  ''
        ];
    }
}
