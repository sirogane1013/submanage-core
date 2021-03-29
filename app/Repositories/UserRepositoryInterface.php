<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Service;

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

    /**
     * Get user by id.
     * 
     * @param int $id
     * @return User
     */
    public function getUserById($id);
}