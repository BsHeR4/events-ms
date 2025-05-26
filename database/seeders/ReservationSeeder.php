<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $events = Event::all();

        foreach ($users as $user) {
            foreach ($events as $event) {
                Reservation::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
            }
        }
    }
}
