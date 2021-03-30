<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
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
     * ログインするテスト
     * 
     * 1. /api/user/registerよりユーザー登録
     * 2. /sanctum/csrf-cookieにGETし、CSRFトークンが返ることを確認
     * 3. /api/user/loginにPOSTしてログイン
     *
     * @return void
     */
    public function testLogin()
    {
        $email = 'test@gmail.com';
        $password = 'password';

        $register_response = $this->post('/api/user/register', [
            'email' => $email,
            'password' => $password,
        ]);
        $register_response->assertOk();

        $csrf_response = $this->get('/sanctum/csrf-cookie');
        $csrf_response->assertCookie('XSRF-TOKEN');

        $response = $this->post('/api/user/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertOk();
    }

    /**
     * ログアウトするテスト
     * 
     * 1. /api/user/logoutにGETしてログアウト
     * 2. 認証されていないことをAssert
     * 3. 認証が必要なapiにアクセスして401が返ることを確認
     *
     * @return void
     */
    public function testLogout()
    {
        $user = User::factory()->create();

        $this->actingAs($user); // login
        $response = $this->get('/api/user/logout'); //logout

        $response->assertOk();
        $this->assertGuest();
    }
}