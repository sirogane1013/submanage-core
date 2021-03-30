<?php

namespace App\Services;

interface SubscriptionManagementServiceInterface
{
    /**
     * List all registered services for the user.
     * 
     * @param User $user
     * @return array
     */
    public function list($user);

    /**
     * Add a subscription service.
     * 
     * @param User $user
     * @param string $name
     * @param int $price
     * @param int $category_id
     * @return Service
     */
    public function add($user, $name, $price, $category_id);

    /**
     * Remove a subscription service.
     * 
     * @param int $id
     * @return Service
     * @throws AuthorizationException
     */
    public function delete($id);
}