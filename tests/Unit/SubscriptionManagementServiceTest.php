<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SubscriptionManagementService;
use Illuminate\Support\Facades\Gate;

class SubscriptionManagementServiceTest extends TestCase
{
    /**
     * サブスクリプションサービス一覧を取得するテスト
     *
     * @return void
     */
    public function testListService()
    {
        // $mockUser = \Mockery::mock('\App\Models\User');
        // $mockUser
        //     ->shouldReceive('services')
        //     ->once();
        // $mockServiceRepository = \Mockery::mock('\App\Repositories\ServiceRepositoryInterface');

        // $management_service = new SubscriptionManagementService($mockServiceRepository);
        // $management_service->list($mockUser);
    }

    /**
     * サブスクリプションサービスを追加するテスト
     *
     * @return void
     */
    public function testAddService()
    {
        $user_id = 1;
        $name = 'test service';
        $price = 980;
        $category_id = 0;
        
        $mockUser = \Mockery::mock('\App\Models\User');
        $mockUser
            ->shouldReceive('addService')
            ->once()
            ->with($name, $price, $category_id);
        $mockServiceRepository = \Mockery::mock('\App\Repositories\ServiceRepositoryInterface');

        $management_service = new SubscriptionManagementService($mockServiceRepository);
        $management_service->add($mockUser, $name, $price, $category_id);
    }

    /**
     * サブスクリプションサービスを削除するテスト
     *
     * @return void
     */
    public function testDeleteService()
    {
        $mockUser = \Mockery::mock('\App\Models\User');
        $mockService = \Mockery::mock('\App\Models\Service');
        $mockService
            ->shouldReceive('delete')
            ->once();
        $mockServiceRepository = \Mockery::mock('\App\Repositories\ServiceRepositoryInterface');
        $mockServiceRepository
            ->shouldReceive('getServiceById')
            ->once()
            ->andReturn($mockService);
        Gate::shouldReceive('allows')
            ->andReturn(true);

        $management_service = new SubscriptionManagementService($mockServiceRepository);
        $management_service->delete(0);
    }
}
