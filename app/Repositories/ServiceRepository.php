<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
    * Get service by id.
    * 
    * @param int id
    * @return Service
    */
    public function getServiceById($id) {
        return Service::find($id);
    }
}