<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    /**
    * Get all categories.
    * 
    * @return Collection
    */
    public function getAllCategories();
}