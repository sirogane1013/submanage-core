<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Service;

class ServiceTest extends TestCase
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
     * サブスクリプションサービスの一覧を取得するテスト
     *
     * @return void
     */
    public function testList()
    {
        $user = User::factory()
            ->has(Service::factory()->count(3))
            ->create();
        $services = $user->services;

        $response = $this->actingAs($user)
            ->getJson('/api/service/list')
        ;

        $response->assertOk();
        $response->assertJson([
            'user_id' => $user->id,
            'services' =>$services->toArray(),
        ]);
    }

    /**
     * サブスクリプションサービスを追加するテスト
     *
     * @return void
     */
    public function testAdd()
    {
        $user = User::factory()->create();

        $name = 'test service';
        $price = 980;
        $category_id = 0;

        $response = $this->actingAs($user)
            ->post('/api/service/add', [
                'name' => $name,
                'price' => $price,
                'category_id' => $category_id,
            ])
        ;
        
        $response->assertOk();
        $this->assertDatabaseHas('services', [
            'name' => $name,
            'price' => $price,
            'user_id' => $user->id,
            'category_id' =>$category_id,
        ]);
    }

    /**
     * サブスクリプションサービスを削除するテスト
     *
     * @return void
     */
    public function testDelete()
    {
        $user = User::factory()
            ->has(Service::factory()->count(3))
            ->create();
        $service = $user->services->first();

        $response = $this->actingAs($user)
            ->delete('/api/service/delete', [
                'id' => $service->id,
            ])
        ;

        $response->assertOk();
        $this->assertDeleted($service);
    }
}
