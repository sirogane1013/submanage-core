<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Service;

class UserTest extends TestCase
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
     * サービスを追加するテスト
     *
     * @return void
     */
    public function testAddService()
    {
        $user = User::factory()->create();

        $name = 'test service';
        $price = 980;
        $category_id = 0;

        $user->addService($name, $price, $category_id);

        $this->assertDatabaseHas('services', [
            'name' => $name,
            'price' => $price,
            'user_id' => $user->id,
            'category_id' =>$category_id,
        ]);
    }
}
