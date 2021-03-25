<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

interface RegisterServiceInterface
{
    /**
    * Register a user.
    * 
    * @param string $email
    * @param string $password
    * @return User
    */
    public function register($email, $password);
}