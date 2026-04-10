<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeriesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => $this->faker->unique()->words(3, true),
            'description'  => $this->faker->paragraph(),
            'genre'        => $this->faker->randomElement(['Drama', 'Comedy', 'Action', 'Thriller', 'Fantasy']),
            'release_year' => $this->faker->numberBetween(1990, 2024),
            'rating'       => $this->faker->randomFloat(1, 5, 10),
            'photo_url'    => null,
            'is_active'    => true,
        ];
    }
}
