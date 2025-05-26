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
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph,
            'max_member' => $this->faker->numberBetween(null, 100),
            'start_time' => now()->addDays(rand(1, 10)),
            'end_time' => fn (array $attributes) => \Carbon\Carbon::parse($attributes['start_time'])->addHours(rand(5, 10)),
        ];
    }
}
