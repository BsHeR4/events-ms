<?php

namespace App\Services;

use App\Models\Event;
use App\Services\Base\BaseCrudService;
use App\Services\Interfaces\EventServiceInterface;

class EventService extends BaseCrudService implements EventServiceInterface
{

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function store(array $data)
    {
        return $this->handle(function () use ($data) {
            $image = $data['image_path'] ?? null;
            unset($data['image_path']);

            $event = parent::store($data);

            if ($image) {
                $this->createOrUpdateImage($event, $image, 'images/events');
            }

            return $event;
        });
    }

    public function update(array $data, string $id)
    {
        return $this->handle(function () use ($data, $id) {
            $image = $data['image_path'] ?? null;
            unset($data['image_path']);

            $event = parent::update($data, $id);

            if ($image) {
                $this->createOrUpdateImage($event, $image, 'images/events');
            }

            return $event;
        });
    }

    public function usersEvents()
    {
        return $this->handle(function () {
            return Event::usersEvents(auth()->id())->get();
        });
    }
}
