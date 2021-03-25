<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Hash;

class RegisterServiceTest extends TestCase
{
    /**
     * ユーザーを追加するテスト
     *
     * @return void
     */
    public function testRegisterUser()
    {
        $email = "test@gmail.com";
        $password = "password";

        $mockUserRepository = \Mockery::mock('\App\Repositories\UserRepositoryInterface');
        $mockUserRepository
            ->shouldReceive('addUser')
            ->once()
            ->withArgs(function ($arg1, $arg2) use ($email, $password) {
                return $arg1 === $email && Hash::check($password, $arg2);
            });
        
        $service = new RegisterService($mockUserRepository);
        $service->register($email, $password);
    }
}
