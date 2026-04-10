<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ActorSeeder::class,
            SeriesSeeder::class,
            SeasonSeeder::class,
            EpisodeSeeder::class,
            ArticleSeeder::class,
            SurveySeeder::class,
            QuizSeeder::class,
        ]);
    }
}