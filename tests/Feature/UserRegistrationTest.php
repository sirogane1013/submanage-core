<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
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
     * 1. /api/user/registerにemailとpasswordをPOST
     * 2. データベースに指定したemailのユーザーが追加されていることを確認
     * 3. 指定したパスワードがハッシュ化されて記録されていることを確認
     * 4. HTTP 200が返って来ていることを確認
     * 
     * @return void
     */
    public function testRegisterUser()
    {
        $email = 'test@gmail.com';
        $password = 'password';

        $response = $this->post('/api/user/register', [
            'email' => $email,
            'password' => $password
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);
        $user = \App\Models\User::where('email', $email)->first();
        $this->assertTrue(Hash::check($password, $user->password));

        $response->assertStatus(200);
    }
}
