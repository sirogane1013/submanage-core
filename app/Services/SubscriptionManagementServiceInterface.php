<?php

namespace App\Services;

interface SubscriptionManagementServiceInterface
{
    /**
     * Return aggrecated information for user.
     * 
     * @param User $user
     * @return array
     */
    public function aggregation($user);
    
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

    /**
     * Update a subscription service.
     * 
     * @param int $id
     * @param string $name
     * @param int $price
     * @param int $category_id
     * @return Service
     * @throws AuthorizationException
     */
    public function update($id, $name, $price, $category_id);
}