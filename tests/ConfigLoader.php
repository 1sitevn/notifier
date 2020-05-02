<?php


namespace OneSite\Notifier\Tests;


use Symfony\Component\Dotenv\Dotenv;

/**
 * Class ConfigLoader
 * @package OneSite\Notifier\Tests
 */
class ConfigLoader
{
    /**
     * @var null
     */
    static private $_instance = null;

    /**
     * ConfigLoader constructor.
     */
    private function __construct()
    {
        $this->loadConfigs();
    }

    /**
     * @return ConfigLoader|null
     */
    static function getInstance()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new ConfigLoader();
        }
        return self::$_instance;
    }

    /**
     * @return array
     */
    public function getConfigs(): array
    {
        return $_ENV;
    }

    /**
     *
     */
    private function loadConfigs()
    {
        $dotenv = new Dotenv();

        $dotenv->load(__DIR__ . '/../.env.test');
    }
}