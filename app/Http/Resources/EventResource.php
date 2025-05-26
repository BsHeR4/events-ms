<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'max_member' => $this->max_member,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'image_path' => optional($this->image)->image_path,
            'organizer' => new UserResource($this->organizer),
            'event_type' => new EventTypeResource($this->eventType),
            'location' => new LocationResource($this->location),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
