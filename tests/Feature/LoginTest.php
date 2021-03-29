<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
     * 3. /api/user/loginにGETしてログイン
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

        $csrf_response = $this->get('/sanctum/csrf-cookie');
        $csrf_response->assertCookie('XSRF-TOKEN');

        $response = $this->get('/api/user/login?email='.$email.'&password='.$password);
        $response->assertOk();
    }
}