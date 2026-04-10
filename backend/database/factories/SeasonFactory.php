<?php

namespace Database\Factories;

use App\Models\Series;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    public function definition(): array
    {
        static $seasonNumber = 1;
        return [
            'series_id'     => Series::factory(),
            'season_number' => $seasonNumber++,
            'title'         => 'Saison ' . $seasonNumber,
            'description'   => $this->faker->sentence(),
            'release_date'  => $this->faker->date(),
            'episode_count' => 0,
        ];
    }
}
