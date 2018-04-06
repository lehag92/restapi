<?php

use Guz\Rest\Autoload\Autoloader;
use Guz\Rest\Routing\Router;

use Guz\Rest\Log\Logger;
use Guz\Rest\Api\Views\Response;

//Get and save project root folder
define('ROOT', dirname(__DIR__) . '/');
require_once(ROOT . 'app/Autoload/Autoloader.php');

try {
    //Autoload for php classes
    new Autoloader();
    //Start routing
    new Router();
} catch (\Exception $exception) {
    new Response(500, "Server Error");
    Logger::write($exception->getMessage());
}

