<?php
namespace Guz\Rest\Api\Controllers;
use Guz\Rest\Config\AppConfig;

/**
 * Class BaseAuthController
 * @package Guz\Rest\Api\Controllers
 */
class BaseAuthController
{
    /**
     * Check if current user is Authorized
     * @return bool
     */
    public function isAuthorized()
    {
        $authData  = AppConfig::getInstance()->getAuthConfig();
        $logins    = array_keys($authData);
        $user      = !empty($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null ;

        return (in_array($user, $logins)) && ($_SERVER['PHP_AUTH_PW'] == $authData[$user]);
    }
}