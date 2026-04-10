<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorSeeder extends Seeder
{
    public function run()
    {
        $actors = [
            [
                'name' => 'Bryan Cranston',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTg1NzQwMDQxNV5BMl5BanBnXkFtZTgwNDg2MjUxMzE@._V1_.jpg',
                'birth_date' => '1956-03-07',
                'biography' => 'Bryan Cranston is an American actor, director, producer, and screenwriter.',
                'imdb_id' => 'nm0186505',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aaron Paul',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTc4NjYyOTYzMF5BMl5BanBnXkFtZTcwMjg5NzYxNw@@._V1_.jpg',
                'birth_date' => '1979-08-27',
                'biography' => 'Aaron Paul is an American actor and producer.',
                'imdb_id' => 'nm0666739',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anna Gunn',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTY0NjU5NjcwN15BMl5BanBnXkFtZTgwNDk5MDUyMDE@._V1_.jpg',
                'birth_date' => '1968-08-11',
                'biography' => 'Anna Gunn is an American actress and producer.',
                'imdb_id' => 'nm0348151',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giancarlo Esposito',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTU1MTE4NzU5OV5BMl5BanBnXkFtZTcwODI0OTUzNw@@._V1_.jpg',
                'birth_date' => '1958-04-26',
                'biography' => 'Giancarlo Esposito is an American actor and director.',
                'imdb_id' => 'nm0000158',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bella Ramsey',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZmU1YzFjYjQtZjJkNS00MzU3LTg1YzktNTY0ZGIzOWRiMWQ3XkEyXkFqcGdeQXVyMjQwMDg0Ng@@._V1_.jpg',
                'birth_date' => '2003-09-30',
                'biography' => 'Bella Ramsey is an English actress.',
                'imdb_id' => 'nm8165600',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro Pascal',
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTc5NjY4MjUwNF5BMl5BanBnXkFtZTgwMzg5OTkwNzE@._V1_.jpg',
                'birth_date' => '1975-04-02',
                'biography' => 'Pedro Pascal is a Chilean-American actor.',
                'imdb_id' => 'nm0050959',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('actors')->insert($actors);
    }
}