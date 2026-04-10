<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriesSeeder extends Seeder
{
    public function run()
    {
        $series = [
            [
                'title' => 'Breaking Bad',
                'description' => 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family\'s future.',
                'genre' => 'Crime, Drama, Thriller',
                'release_year' => 2008,
                'rating' => 9.5,
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMTJiMzgwZTktYzZhZC00YzhhLThmMmYtZjUwZDBjNjRhYjI3XkEyXkFqcGdeQXVyMTAyOTE2ODg0._V1_.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Game of Thrones',
                'description' => 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.',
                'genre' => 'Action, Adventure, Drama',
                'release_year' => 2011,
                'rating' => 9.2,
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Last of Us',
                'description' => 'After a global pandemic destroys civilization, a hardened survivor takes charge of a 14-year-old girl who may be humanity\'s last hope.',
                'genre' => 'Action, Adventure, Drama',
                'release_year' => 2023,
                'rating' => 8.8,
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZGUzYTI3M2EtZmM0Yy00NGU3LTRkYjItYmYzNzQ2M2FhNGRjXkEyXkFqcGdeQXVyNjMwMzc3MjE@._V1_.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Stranger Things',
                'description' => 'When a young boy vanishes, a small town uncovers a mystery involving secret experiments, terrifying supernatural forces and one strange little girl.',
                'genre' => 'Drama, Fantasy, Horror',
                'release_year' => 2016,
                'rating' => 8.7,
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BMDZkYmVhNjMtNWU4MC00MDQxLWE3MjYtZGMzZWI1ZjhlOWJmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Mandalorian',
                'description' => 'The travels of a lone Mandalorian warrior in the outer reaches of the galaxy, far from the authority of the New Republic.',
                'genre' => 'Action, Adventure, Fantasy',
                'release_year' => 2019,
                'rating' => 8.7,
                'photo_url' => 'https://m.media-amazon.com/images/M/MV5BZDhlMzY0ZGItZTcyNS00ZTAxLWIyMmYtZGQ2ODg5OWZiYmJkXkEyXkFqcGdeQXVyODkzNTgxMDg@._V1_.jpg',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('series')->insert($series);
        
        // Associate actors with series
        $seriesActors = [
            // Breaking Bad
            ['series_id' => 1, 'actor_id' => 1, 'character_name' => 'Walter White', 'order' => 1],
            ['series_id' => 1, 'actor_id' => 2, 'character_name' => 'Jesse Pinkman', 'order' => 2],
            ['series_id' => 1, 'actor_id' => 3, 'character_name' => 'Skyler White', 'order' => 3],
            ['series_id' => 1, 'actor_id' => 4, 'character_name' => 'Gus Fring', 'order' => 4],
            
            // Game of Thrones
            ['series_id' => 2, 'actor_id' => 5, 'character_name' => 'Lyanna Mormont', 'order' => 1],
            ['series_id' => 2, 'actor_id' => 6, 'character_name' => 'Oberyn Martell', 'order' => 2],
            
            // The Last of Us
            ['series_id' => 3, 'actor_id' => 5, 'character_name' => 'Ellie', 'order' => 1],
            ['series_id' => 3, 'actor_id' => 6, 'character_name' => 'Joel', 'order' => 2],
            
            // Stranger Things
            ['series_id' => 4, 'actor_id' => 5, 'character_name' => 'Lynda', 'order' => 1],
            
            // The Mandalorian
            ['series_id' => 5, 'actor_id' => 6, 'character_name' => 'The Mandalorian', 'order' => 1],
        ];
        
        DB::table('series_actors')->insert($seriesActors);
    }
}