<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
    * Add a user.
    * 
    * @param string $email
    * @param string $password
    * @return User
    */
    public function addUser($email, $password) {
        // TODO: ユーザー追加に失敗した時の例外処理
        $user = new User;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        return $user;
    }
}