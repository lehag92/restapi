<?php

namespace Guz\Rest\Autoload;

/**
 * Class Autoloader implements PSR-4 autoload
 * @see https://www.php-fig.org/psr/psr-4/
 * @package Autoload
 */
class Autoloader
{
    public function __construct()
    {
        spl_autoload_register([$this, 'loader']);
    }

    /**
     * @param string $class
     * @throws \Exception
     */
    private function loader($class)
    {

        $autoloadFile = ROOT . 'app/Config/config.php';
        if (file_exists($autoloadFile)) {
            $config = include($autoloadFile);
        } else {
            throw new \Exception('No config file in "Config" folder');
        }
        if (empty($config['autoload'])) {
            return;
        }
        foreach ($config['autoload'] as $prefix => $dir) {
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) == 0) {
                $relativeClass = substr($class, $len);
                $file = ROOT . $dir . str_replace('\\', '/', $relativeClass) . '.php';
                if (file_exists($file)) {
                    require $file;
                }
            }
        }
    }
}