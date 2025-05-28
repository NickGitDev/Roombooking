<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Salle ' . strtoupper($this->faker->bothify('??-###')),
            'capacity' => $this->faker->numberBetween(5, 50),
            'description' => $this->faker->sentence(),
        ];
    }
}
