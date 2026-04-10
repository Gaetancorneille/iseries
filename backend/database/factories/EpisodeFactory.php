<?php

namespace Database\Factories;

use App\Models\Series;
use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    public function definition(): array
    {
        static $epNumber = 1;
        return [
            'series_id'      => Series::factory(),
            'season_id'      => Season::factory(),
            'episode_number' => $epNumber++,
            'title'          => $this->faker->sentence(4),
            'description'    => $this->faker->paragraph(),
            'duration'       => $this->faker->numberBetween(20, 90),
            'release_date'   => $this->faker->date(),
            'video_url'      => null,
            'photo_url'      => null,
        ];
    }
}
