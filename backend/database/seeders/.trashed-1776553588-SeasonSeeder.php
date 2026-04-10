<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        $seasons = [
            // Breaking Bad seasons
            [
                'series_id' => 1,
                'season_number' => 1,
                'title' => 'Saison 1',
                'description' => 'Walter White découvre sa maladie et commence sa transformation',
                'release_date' => '2008-01-20',
                'episode_count' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'series_id' => 1,
                'season_number' => 2,
                'title' => 'Saison 2',
                'description' => 'L\'empire de Walter et Jesse se développe',
                'release_date' => '2009-03-08',
                'episode_count' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'series_id' => 1,
                'season_number' => 3,
                'title' => 'Saison 3',
                'description' => 'L\'entrée de Gus Fring dans l\'histoire',
                'release_date' => '2010-03-21',
                'episode_count' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'series_id' => 1,
                'season_number' => 4,
                'title' => 'Saison 4',
                'description' => 'La guerre entre Walter et Gus',
                'release_date' => '2011-07-17',
                'episode_count' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'series_id' => 1,
                'season_number' => 5,
                'title' => 'Saison 5',
                'description' => 'Le dénouement final',
                'release_date' => '2012-07-15',
                'episode_count' => 16,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Game of Thrones seasons
            [
                'series_id' => 2,
                'season_number' => 1,
                'title' => 'Saison 1',
                'description' => 'Le début de l\'histoire de Westeros',
                'release_date' => '2011-04-17',
                'episode_count' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // The Last of Us seasons
            [
                'series_id' => 3,
                'season_number' => 1,
                'title' => 'Saison 1',
                'description' => 'L\'histoire de Joel et Ellie',
                'release_date' => '2023-01-15',
                'episode_count' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('seasons')->insert($seasons);
    }
}