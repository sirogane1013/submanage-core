<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
    * Add a user.
    * 
    * @param string $email
    * @param string $password
    * @return User
    */
    public function addUser($email, $password);
}