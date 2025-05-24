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

    public function store(array $data)
    {
        return $this->handle(function () use ($data) {
            $image = $data['image_path'] ?? null;
            unset($data['image_path']);

            $location = parent::store($data);

            if ($image) {
                $this->createOrUpdateImage($location, $image, 'images/locations');
            }

            return $location;
        });
    }

    public function update(array $data, string $id)
    {
        return $this->handle(function () use ($data, $id) {
            $image = $data['image_path'] ?? null;
            unset($data['image_path']);

            $location = parent::update($data, $id);

            if ($image) {
                $this->createOrUpdateImage($location, $image, 'images/locations');
            }

            return $location;
        });
    }
}
