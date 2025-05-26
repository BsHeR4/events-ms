<?php

namespace App\Services;

use App\Models\Reservation;
use App\Services\Base\BaseCrudService;
use App\Services\Interfaces\ReservationServiceInterface;

class ReservationService extends BaseCrudService implements ReservationServiceInterface
{
    public function __construct(Reservation $model)
    {
        $this->model = $model;
    }
}
