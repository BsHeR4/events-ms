<?php

namespace App\Services;

use App\Models\Location;
use App\Services\Base\BaseCrudService;
use App\Services\Interfaces\LocationServiceInterface;

class LocationService extends BaseCrudService implements LocationServiceInterface
{
    public function __construct(Location $model)
    {
        $this->model = $model;
    }
}
