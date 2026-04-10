<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'      => $this->faker->name(),
            'photo_url' => null,
            'birth_date'=> $this->faker->date(),
            'biography' => $this->faker->paragraph(),
            'imdb_id'   => null,
        ];
    }
}
