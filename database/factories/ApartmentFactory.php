<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'title' => fake()->words(rand(1, 5), true),
            'description' => fake()->text(rand(50, 100)),
            'room_number' => fake()->randomNumber(1, true),
            'bed_number' => fake()->randomNumber(1, true),
            'bath_number' => fake()->randomNumber(1, true),
            'square_meters' => fake()->randomNumber(4, true),
            'address' => fake()->address(),
            'latitude' => fake()->latitude($min = -90, $max = 90),
            'longitude' => fake()->longitude($min = -180, $max = 180),
            'img' => fake()->imageUrl(640, 480, 'animals', true),
            'visible' => fake()->boolean(),
        ];
    }
}