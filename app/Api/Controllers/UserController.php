<?php

namespace Guz\Rest\Api\Controllers;

use Guz\Rest\Api\Models\UserModel;
use Guz\Rest\Api\Views\Response;

/**
 * Class UserController
 * @package Guz\Rest\Api\Controllers
 */
class UserController
{
    public function getUsersAction()
    {

       $users =  (new UserModel())->findAll();
       if (!empty($users)) {
           foreach ($users as $id => $userData){
               $data[] = array_merge(['userId '=> $id], $userData);
           }
           new Response(200, 'OK', $data);
       }
       new Response(404,_('Not found'));
    }
    public function getUserAction($id)
    {
        $user =  (new UserModel())->findUserById($id);
        if (!empty($user)) {
            //Add user id to response
            $user = array_merge(['userId '=> $id], $user);
            new Response(200, 'OK', $user);
        }
        new Response(404,_('User not found'));
    }
}