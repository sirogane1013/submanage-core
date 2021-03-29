<?php

namespace App\Repositories;

interface ServiceRepositoryInterface
{
    /**
    * Get service by id.
    * 
    * @param int id
    * @return Service
    */
    public function getServiceById($id);
}