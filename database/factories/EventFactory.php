<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $start = now()->addDays(rand(1, 5));
        $end = (clone $start)->addHours(rand(1, 6));

        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph,
            'max_member' => $this->faker->numberBetween(null, 100),
            'start_time' => $start,
            'end_time' => $end,
        ];
    }
}
