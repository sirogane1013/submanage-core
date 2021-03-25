<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    /**
     * SetUp
     *
     */
    protected function setUp() :void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    /**
     * ユーザーを追加するテスト
     *
     * @return void
     */
    public function testAddUser()
    {
        $email = "test@gmail.com";
        $password = '$2y$04$kpC1r79f3vog9uBZQQc4Z.Yq.m/.goukKMO5SGcBbUIRYm0AnVmJ2';

        $repository = new UserRepository();
        $repository->addUser($email, $password);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'password' => $password
        ]);
    }
}
