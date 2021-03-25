<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class RegisterService implements RegisterServiceInterface
{
    public function __construct(UserRepositoryInterface $user_repository) {
        $this->user_repository = $user_repository;
    }

    /**
    * Register a user.
    * 
    * @param string $email
    * @param string $password
    * @return User
    */

    public function register($email, $password) {
        $user = $this->user_repository->addUser($email, Hash::make($password));
        return $user;
    }
}