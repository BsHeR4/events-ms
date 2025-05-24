<?php

namespace App\Services;

use App\Models\EventType;
use App\Services\Base\BaseCrudService;
use App\Services\Interfaces\EventTypeServiceInterface;

class EventTypeService extends BaseCrudService implements EventTypeServiceInterface
{
    public function __construct(EventType $model)
    {
        $this->model = $model;
    }
}
