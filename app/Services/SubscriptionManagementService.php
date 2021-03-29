<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ServiceRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class SubscriptionManagementService implements SubscriptionManagementServiceInterface
{
    public function __construct(ServiceRepositoryInterface $service_repository) {
        $this->service_repository = $service_repository;
    }

    /**
     * List all registered services for the user.
     * 
     * @param User $user
     * @return array
     */
    public function list($user) {
        return [
            'user_id' => $user->id,
            'services' => $user->services,
        ];
    }

    /**
     * Add a subscription service.
     * 
     * @param User $user
     * @param string $name
     * @param int $price
     * @param int $category_id
     * @return Service
     */
    public function add($user, $name, $price, $category_id) {
        $service = $user->addService($name, $price, $category_id);
        
        return $service;
    }

    /**
     * Remove a subscription service.
     * 
     * @param int $id
     * @return Service
     * @throws AuthorizationException
     */
    public function delete($id) {
        $service = $this->service_repository->getServiceById($id);
        if (! Gate::allows('delete-service', $service)) {
            throw new AuthorizationException;
        }
        
        return $service->delete();
    }
}