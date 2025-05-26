<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        $organizer = User::factory()->create([
            'email' => 'organizer@example.com',
        ]);
        $organizer->assignRole('organizer');

        User::factory(20)->create();
    }
}
