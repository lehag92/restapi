<?php
namespace Guz\Rest\Routing;

use Guz\Rest\Config\AppConfig;
use Guz\Rest\Api\Controllers\BaseAuthController;
use Guz\Rest\Api\Views\Response;
/**
 * Class Router
 * @package Guz\Rest\Routing
 */
class Router
{
    /**
     * @var array
     */
    private $getRoutes = [];
    /**
     * @var array
     */
    private $postRoutes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        //Check Base Auth
        if (!(new BaseAuthController())->isAuthorized()) {
            new Response(401, "Not Authorized");
        }

        $routeConfig = AppConfig::getInstance()->getRoutingConfig();
        if (empty($routeConfig)) {
            throw new \Exception("Empty routing config");
        }
        //Separate config depending on request type (don't need to process other types)
        $this->getRoutes  = !empty($routeConfig['GET']) ? $routeConfig['GET'] : [];
        $this->postRoutes = !empty($routeConfig['POST']) ? $routeConfig['POST'] : [];

        $this->processRequest();
    }

    /**
     * Modify routes for using with regexp
     * @param array $routes
     * @return array
     */
    private function modifyRoutes($routes)
    {
        $results = [];
        foreach ($routes as $url => $config) {

            $url = rtrim($url, '/') . '/?';
            // For digits (0-9), format: <:variable_name>
            $url = preg_replace('/\<\:(.*?)\>/', '(?P<\1>[0-9]+)', $url);
            // Add full match
            $results['#^' . $url . '$#'] =  $config;
        }

        return $results;
    }


    /**
     * Process current request
     */
    private function processRequest()
    {
        $routeFound = false;
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $routeFound = $this->matchRoutes($this->getRoutes);
                break;
            case 'POST':
                $routeFound = $this->matchRoutes($this->postRoutes);
                break;
        }

        if (!$routeFound) {
            new Response(404,"Not Found");
        }
    }

    /**
     * @param array $config
     * @param mixed $param
     */
    private function dispatch($config, $param = null)
    {
        $action = !empty($config['action']) && trim($config['action']) !== '' ? $config['action'] : null;
        if (!is_null($action)) {
            //Creating Controller instance. Class must be fully specified
            $instance = new $config['class'];
            call_user_func([$instance, $action], $param);
        }
    }

    /**
     * @param $routes
     * @return bool
     */
    private function matchRoutes($routes)
    {
        $routes = $this->modifyRoutes($routes);
        $matched = false;
        $param = null;
        foreach ($routes as $url => $config) {
            if (preg_match($url, $_SERVER['REQUEST_URI'], $matches)) {
                // Get any named parameters from the route
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $param = $match;
                    }
                }

                $this->dispatch($config, $param);
                $matched = true;
            }
        }

        return $matched;
    }
}