<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\ServiceRepository;

class ServiceRepositoryTest extends TestCase
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
     * サービスを取得するテスト
     *
     * @return void
     */
    public function testGetService()
    {
        $user = \App\Models\User::factory()
            ->has(\App\Models\Service::factory()->count(3))
            ->create();
        $service = $user->services->first();
        $service_id = $service->id;

        $repository = new ServiceRepository();
        $found_service = $repository->getServiceById($service_id);
        $this->assertEquals($service, $found_service);
    }
}
