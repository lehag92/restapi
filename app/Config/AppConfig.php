<?php

namespace Guz\Rest\Config;
/**
 * Class AppConfig
 * @package Guz\Rest\Config
 */
class AppConfig
{
    /**
     * @var AppConfig
     */
    protected static $instance;
    /**
     * @var array Array for autoloading
     */
    protected $autoload = [];
    /**
     * @var array Array for athentication
     */
    protected $authData = [];
    /**
     * @var array Array for routing
     */
    protected $routing = [];

    /**
     * AppConfig constructor.
     * @throws \Exception
     */
    protected function __construct()
    {
        $configFile = ROOT . 'app/Config/config.php';
        if (file_exists($configFile)) {
            $config = include $configFile;
            $this->routing  = !empty($config['routing']) ? $config['routing'] : [];
            $this->authData = !empty($config['baseauth']) ? $config['baseauth'] : [];
            $this->autoload = !empty($config['autoload']) ? $config['autoload'] : [];
        } else {
            throw new \Exception('No autoload config file in "Config" folder');
        }

    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return AppConfig
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new AppConfig();
            return self::$instance;
        } else {
            return self::$instance;
        }
    }

    /**
     * @return array
     */
    public function getAutoloadConfig()
    {
        return $this->autoload;
    }

    /**
     * @return array
     */
    public function getAuthConfig()
    {
        return $this->authData;
    }

    /**
     * @return array
     */
    public function getRoutingConfig()
    {
        return $this->routing;
    }
}