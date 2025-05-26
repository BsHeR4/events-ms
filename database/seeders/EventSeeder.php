<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = EventType::all();
        $locations = Location::all();
        $organizer = User::role('organizer')->get();
        Event::factory(20)->create(
            [
                'organizer_id' => $organizer[0]->id,
                'event_type_id' => $eventTypes->random()->id,
                'location_id' => $locations->random()->id,
            ]
        );
    }
}
