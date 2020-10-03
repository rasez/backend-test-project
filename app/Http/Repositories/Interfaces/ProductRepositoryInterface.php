<?php

namespace App\Http\Repositories\Interfaces;

interface ProductRepositoryInterface
{

    public function create($category, $csvrow);

}

