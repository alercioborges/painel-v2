<?php

namespace app\config;

class App
{

    private array $dataConfig;

    public function __construct()
    {
        $this->dataConfig = [
            'env'   => $_ENV['APP_NODE_ENV'] ?? 'production',
            'debug' => ($_ENV['APP_DEBUG'] ?? 'false') === 'true',
            'dir'   => $_ENV['APP_BASE_DIR'] ??  ''
        ];
    }


    public static function config()
    {
        static $config = new App();
        return $config;
    }


    public function get($key)
    {
        return $this->dataConfig[$key];
    }
}
