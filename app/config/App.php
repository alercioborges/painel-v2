<?php

namespace app\config;

class App
{
    private array $dataConfig = [];

    public function __construct()
    {
        $this->dataConfig['env']   = $_ENV['APP_NODE_ENV'] ?? 'production';
        $this->dataConfig['debug'] = ($_ENV['APP_DEBUG'] ?? 'false') === 'true';
        $this->dataConfig['dir']   = $_ENV['APP_BASE_DIR'] ?? '';
        $this->dataConfig['url']   = $this->getBaseUrl();
    }
    

    private function getBaseUrl(): string
    {
        $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
        $protocol = $isHttps ? 'https://' : 'http://';

        return $protocol . $_SERVER['HTTP_HOST'] . $this->dataConfig['dir'];
    }

    public static function config(): self
    {
        static $config;
        if (!$config) {
            $config = new self();
        }
        return $config;
    }

    public function get(string $key)
    {
        return $this->dataConfig[$key] ?? null;
    }
}
