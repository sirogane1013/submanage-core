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
     * 1. /sanctum/csrf-cookieにGETし、CSRFトークンが返ることを確認
     * TODO:以降を書く
     *
     * @return void
     */
    public function testLogin()
    {
        $email = 'test@gmail.com';
        $password = 'password';

        $response = $this->get('/sanctum/csrf-cookie');
        $response->assertCookie('XSRF-TOKEN');

    }
}