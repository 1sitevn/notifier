<?php


namespace OneSite\Notifier;


/**
 * Class Config
 * @package OneSite\Notifier
 */
class Config
{
    /**
     * @var null
     */
    static private $_instance = null;

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return static|null
     */
    static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * @param $key
     * @param null $default
     * @return array|mixed|null
     */
    public function get($key, $default = null)
    {
        if (!function_exists('config')) {
            return $default;
        }

        return config($key, $default);
    }
}
