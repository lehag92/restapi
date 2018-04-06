<?php

namespace Guz\Rest\Api\Models;

class UserModel
{
    /**
     * @var array Users Stub
     */
    protected $users = [
        '1' => [
            'firstName'=> 'Ivan',
            'lastName'=> 'Pupkin',
            'age'=>'26',
            'sex'=>'male',
            'city' =>'Kyiv',
            'adress'=>'Malinovskogo 189'
        ],
        '2' => [
            'firstName'=> 'Ania',
            'lastName'=> 'Krach',
            'age'=>'19',
            'sex'=>'female',
            'city' =>'Lviv',
            'adress'=>'Ploscha rinok 25'
        ],
        '3' => [
            'firstName'=> 'Aliona',
            'lastName'=> 'Vedmed',
            'age'=>'33',
            'sex'=>'female',
            'city' =>'Odesa',
            'adress'=>'Shevchenka 13'
        ],
    ];

    /**
     * @param int $id
     * @return array
     */
    public function findUserById($id)
    {
        if (!empty($this->users[$id])) {
            return $this->users[$id];
        }
        return [];
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->users;
    }
}