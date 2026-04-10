<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    public function run()
    {
        $episodes = [
            // Breaking Bad Season 1 episodes
            [
                'season_id' => 1,
                'series_id' => 1,
                'episode_number' => 1,
                'title' => 'Pilot',
                'description' => 'Walter White, un professeur de chimie de lycée, découvre qu\'il a un cancer du poumon inopérable. Il se tourne vers la fabrication de méthamphétamine pour assurer l\'avenir financier de sa famille.',
                'duration' => 58,
                'release_date' => '2008-01-20',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZDNhNzhkNDYtYmUyZS00YzJmLWFlZGMtMTlhZjY0M2ZmOTY1XkEyXkFqcGdeQXVyMTMzNDExODE5._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_id' => 1,
                'series_id' => 1,
                'episode_number' => 2,
                'title' => 'Cat\'s in the Bag...',
                'description' => 'Walter et Jesse doivent faire face aux conséquences de leur première fabrication de méthamphétamine.',
                'duration' => 48,
                'release_date' => '2008-01-27',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTI5MjEyMTM5OV5BMl5BanBnXkFtZTcwMjQwOTU5MQ@@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Breaking Bad Season 5 episodes
            [
                'season_id' => 5,
                'series_id' => 1,
                'episode_number' => 1,
                'title' => 'Live Free or Die',
                'description' => 'Walter, Mike et Jesse font face aux conséquences de l\'explosion du cartel.',
                'duration' => 49,
                'release_date' => '2012-07-15',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTU5MjM5MjUwN15BMl5BanBnXkFtZTcwMDQ5MzQ0Nw@@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_id' => 5,
                'series_id' => 1,
                'episode_number' => 16,
                'title' => 'Felina',
                'description' => 'Dans le dernier épisode de la série, Walter revient à Albuquerque pour régler ses affaires en suspens.',
                'duration' => 57,
                'release_date' => '2013-09-29',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTU1MzM5NzU1MF5BMl5BanBnXkFtZTgwNzQ0NjMxMTE@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // The Last of Us Season 1 episodes
            [
                'season_id' => 7,
                'series_id' => 3,
                'episode_number' => 1,
                'title' => 'When You\'re Lost in the Darkness',
                'description' => 'Dans un monde post-apocalyptique ravagé par une pandémie de champignons, Joel doit escorter Ellie à travers les États-Unis.',
                'duration' => 81,
                'release_date' => '2023-01-15',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZGUzYTI3M2EtZmM0Yy00NGU3LTRkYjItYmYzNzQ2M2FhNGRjXkEyXkFqcGdeQXVyNjMwMzc3MjE@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_id' => 7,
                'series_id' => 3,
                'episode_number' => 9,
                'title' => 'Look at the Time',
                'description' => 'Joel et Ellie arrivent à Salt Lake City et découvrent la vérité sur l\'immunité d\'Ellie.',
                'duration' => 77,
                'release_date' => '2023-03-12',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZmQ5YjY0ZjItYjFhYS00ZDc1LTg2MzEtZjg3YzZjMzY4YzQxXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('episodes')->insert($episodes);
    }
}