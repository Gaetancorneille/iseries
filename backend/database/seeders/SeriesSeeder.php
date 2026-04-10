<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeriesSeeder extends Seeder
{
    public function run()
    {
        // ── Séries (IDs 1-15) ─────────────────────────────────────────────────
        $series = [
            // ID 1
            ['title' => 'Breaking Bad',        'description' => 'Un professeur de chimie atteint d\'un cancer incurable se reconvertit dans la fabrication de méthamphétamine pour assurer l\'avenir de sa famille.', 'genre' => 'Crime, Drama, Thriller',       'release_year' => 2008, 'rating' => 9.5, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 2
            ['title' => 'Game of Thrones',     'description' => 'Neuf grandes familles se battent pour le contrôle des Sept Couronnes de Westeros, tandis qu\'un ancien ennemi revient après des millénaires d\'absence.', 'genre' => 'Action, Adventure, Drama',    'release_year' => 2011, 'rating' => 9.2, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 3
            ['title' => 'The Last of Us',      'description' => 'Après une pandémie mondiale, un survivant endurci escorte une jeune fille de 14 ans qui pourrait être le dernier espoir de l\'humanité.', 'genre' => 'Action, Adventure, Drama',    'release_year' => 2023, 'rating' => 8.8, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 4
            ['title' => 'Stranger Things',     'description' => 'Quand un jeune garçon disparaît, une petite ville découvre un mystère impliquant des expériences secrètes et des forces surnaturelles terrifiantes.', 'genre' => 'Drama, Fantasy, Horror',      'release_year' => 2016, 'rating' => 8.7, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 5
            ['title' => 'The Mandalorian',     'description' => 'Les aventures d\'un chasseur de primes solitaire mandalorien dans les recoins les plus éloignés de la galaxie, loin de l\'autorité de la Nouvelle République.', 'genre' => 'Action, Adventure, Fantasy', 'release_year' => 2019, 'rating' => 8.7, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 6
            ['title' => 'Charmed',             'description' => 'Trois sœurs découvrent qu\'elles sont les Sorcières du Charme, les sorcières les plus puissantes de tous les temps, destinées à protéger les innocents des forces démoniaques.', 'genre' => 'Drama, Fantasy, Mystery',   'release_year' => 1998, 'rating' => 7.2, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 7
            ['title' => 'The Big Bang Theory', 'description' => 'Un groupe de physiciens géniaux mais socialement maladroits voient leur vie quotidienne bouleversée quand une belle serveuse s\'installe en face de chez eux.', 'genre' => 'Comedy, Romance',            'release_year' => 2007, 'rating' => 8.1, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 8
            ['title' => 'Friends',             'description' => 'Six amis trentenaires naviguent entre amour, amitié et carrière dans la ville de New York, se retrouvant autour d\'un café dans leur appartement commun.', 'genre' => 'Comedy, Romance',            'release_year' => 1994, 'rating' => 8.9, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 9
            ['title' => 'Une Nounou d\'Enfer', 'description' => 'Fran Fine, une vendeuse de cosmétiques new-yorkaise au caractère bien trempé, devient nounou d\'un producteur de Broadway londonien veuf et de ses trois enfants.', 'genre' => 'Comedy, Family, Romance',   'release_year' => 1993, 'rating' => 7.2, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 10
            ['title' => 'Mercredi',            'description' => 'Mercredi Addams tente de maîtriser ses pouvoirs psychiques alors qu\'elle enquête sur une série de meurtres dans la ville de Jericho et à l\'académie Nevermore.', 'genre' => 'Comedy, Fantasy, Horror',   'release_year' => 2022, 'rating' => 8.1, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 11
            ['title' => 'Suits',               'description' => 'Un avocat brillant embauche un imposteur sans diplôme de droit mais au génie exceptionnel, et ensemble ils forment l\'équipe juridique la plus redoutable de New York.', 'genre' => 'Drama',                      'release_year' => 2011, 'rating' => 8.5, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 12
            ['title' => 'Scandal',             'description' => 'Olivia Pope, ancienne communicante de la Maison-Blanche, gère les crises des personnalités les plus puissantes de Washington tout en navigant dans une relation secrète avec le Président.', 'genre' => 'Drama, Thriller',           'release_year' => 2012, 'rating' => 7.9, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 13
            ['title' => 'Bones',               'description' => 'Une anthropologue judiciaire aux méthodes scientifiques et un agent du FBI aux méthodes intuitives forment un duo improbable pour résoudre des crimes complexes.', 'genre' => 'Crime, Drama, Mystery',      'release_year' => 2005, 'rating' => 7.8, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 14
            ['title' => 'The Vampire Diaries', 'description' => 'Elena Gilbert, une lycéenne ordinaire, se retrouve au cœur d\'une rivalité entre deux frères vampires dans la petite ville de Mystic Falls.', 'genre' => 'Drama, Fantasy, Horror',     'release_year' => 2009, 'rating' => 7.7, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            // ID 15
            ['title' => 'Once Upon a Time',    'description' => 'Dans la ville de Storybrooke, des personnages de contes de fées ont été arrachés à leur monde et condamnés à vivre dans le nôtre, sans souvenir de leur véritable identité.', 'genre' => 'Adventure, Drama, Fantasy',  'release_year' => 2011, 'rating' => 7.8, 'is_active' => true, 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('series')->insert($series);

        // ── Associations acteurs-séries ────────────────────────────────────────
        $seriesActors = [
            // Breaking Bad (ID 1) → acteurs 1-4
            ['series_id' => 1, 'actor_id' => 1, 'character_name' => 'Walter White / Heisenberg', 'order' => 1],
            ['series_id' => 1, 'actor_id' => 2, 'character_name' => 'Jesse Pinkman',              'order' => 2],
            ['series_id' => 1, 'actor_id' => 3, 'character_name' => 'Skyler White',               'order' => 3],
            ['series_id' => 1, 'actor_id' => 4, 'character_name' => 'Gus Fring',                  'order' => 4],

            // Game of Thrones (ID 2) → acteurs 5-6
            ['series_id' => 2, 'actor_id' => 5,  'character_name' => 'Lyanna Mormont',   'order' => 1],
            ['series_id' => 2, 'actor_id' => 27, 'character_name' => 'Brienne de Torth', 'order' => 2],

            // The Last of Us (ID 3) → acteurs 5-6
            ['series_id' => 3, 'actor_id' => 6, 'character_name' => 'Joel Miller',  'order' => 1],
            ['series_id' => 3, 'actor_id' => 5, 'character_name' => 'Ellie Williams','order' => 2],

            // Stranger Things (ID 4)
            ['series_id' => 4, 'actor_id' => 5, 'character_name' => 'Personnage principal', 'order' => 1],

            // The Mandalorian (ID 5)
            ['series_id' => 5, 'actor_id' => 6, 'character_name' => 'Din Djarin / The Mandalorian', 'order' => 1],

            // Charmed (ID 6) → acteurs 7-10
            ['series_id' => 6, 'actor_id' => 7,  'character_name' => 'Phoebe Halliwell', 'order' => 1],
            ['series_id' => 6, 'actor_id' => 8,  'character_name' => 'Prue Halliwell',   'order' => 2],
            ['series_id' => 6, 'actor_id' => 9,  'character_name' => 'Piper Halliwell',  'order' => 3],
            ['series_id' => 6, 'actor_id' => 10, 'character_name' => 'Paige Matthews',   'order' => 4],

            // The Big Bang Theory (ID 7) → acteurs 11-15
            ['series_id' => 7, 'actor_id' => 11, 'character_name' => 'Sheldon Cooper',          'order' => 1],
            ['series_id' => 7, 'actor_id' => 12, 'character_name' => 'Leonard Hofstadter',      'order' => 2],
            ['series_id' => 7, 'actor_id' => 13, 'character_name' => 'Penny',                   'order' => 3],
            ['series_id' => 7, 'actor_id' => 14, 'character_name' => 'Amy Farrah Fowler',       'order' => 4],
            ['series_id' => 7, 'actor_id' => 15, 'character_name' => 'Bernadette Rostenkowski', 'order' => 5],

            // Friends (ID 8) → acteurs 16-21
            ['series_id' => 8, 'actor_id' => 16, 'character_name' => 'Rachel Green',   'order' => 1],
            ['series_id' => 8, 'actor_id' => 17, 'character_name' => 'Monica Geller',  'order' => 2],
            ['series_id' => 8, 'actor_id' => 18, 'character_name' => 'Phoebe Buffay',  'order' => 3],
            ['series_id' => 8, 'actor_id' => 19, 'character_name' => 'Joey Tribbiani', 'order' => 4],
            ['series_id' => 8, 'actor_id' => 20, 'character_name' => 'Chandler Bing',  'order' => 5],
            ['series_id' => 8, 'actor_id' => 21, 'character_name' => 'Ross Geller',    'order' => 6],

            // Une Nounou d'Enfer (ID 9) → acteurs 22-25
            ['series_id' => 9, 'actor_id' => 22, 'character_name' => 'Fran Fine',          'order' => 1],
            ['series_id' => 9, 'actor_id' => 23, 'character_name' => 'Maxwell Sheffield',  'order' => 2],
            ['series_id' => 9, 'actor_id' => 24, 'character_name' => 'Niles',              'order' => 3],
            ['series_id' => 9, 'actor_id' => 25, 'character_name' => 'C.C. Babcock',       'order' => 4],

            // Mercredi (ID 10) → acteurs 26-28
            ['series_id' => 10, 'actor_id' => 26, 'character_name' => 'Mercredi Addams',        'order' => 1],
            ['series_id' => 10, 'actor_id' => 27, 'character_name' => 'Directrice Weems',       'order' => 2],
            ['series_id' => 10, 'actor_id' => 28, 'character_name' => 'Morticia Addams',        'order' => 3],

            // Suits (ID 11) → acteurs 29-32
            ['series_id' => 11, 'actor_id' => 29, 'character_name' => 'Harvey Specter', 'order' => 1],
            ['series_id' => 11, 'actor_id' => 30, 'character_name' => 'Mike Ross',      'order' => 2],
            ['series_id' => 11, 'actor_id' => 31, 'character_name' => 'Rachel Zane',    'order' => 3],
            ['series_id' => 11, 'actor_id' => 32, 'character_name' => 'Jessica Pearson','order' => 4],

            // Scandal (ID 12) → acteurs 33-35
            ['series_id' => 12, 'actor_id' => 33, 'character_name' => 'Olivia Pope',         'order' => 1],
            ['series_id' => 12, 'actor_id' => 34, 'character_name' => 'Président Grant',     'order' => 2],
            ['series_id' => 12, 'actor_id' => 35, 'character_name' => 'Abby Whelan',         'order' => 3],

            // Bones (ID 13) → acteurs 36-38
            ['series_id' => 13, 'actor_id' => 36, 'character_name' => 'Dr. Temperance Brennan', 'order' => 1],
            ['series_id' => 13, 'actor_id' => 37, 'character_name' => 'Seeley Booth',           'order' => 2],
            ['series_id' => 13, 'actor_id' => 38, 'character_name' => 'Angela Montenegro',      'order' => 3],

            // The Vampire Diaries (ID 14) → acteurs 39-42
            ['series_id' => 14, 'actor_id' => 39, 'character_name' => 'Elena Gilbert',   'order' => 1],
            ['series_id' => 14, 'actor_id' => 40, 'character_name' => 'Stefan Salvatore','order' => 2],
            ['series_id' => 14, 'actor_id' => 41, 'character_name' => 'Damon Salvatore', 'order' => 3],
            ['series_id' => 14, 'actor_id' => 42, 'character_name' => 'Caroline Forbes', 'order' => 4],

            // Once Upon a Time (ID 15) → acteurs 43-46
            ['series_id' => 15, 'actor_id' => 43, 'character_name' => 'Blanche-Neige / Mary Margaret', 'order' => 1],
            ['series_id' => 15, 'actor_id' => 44, 'character_name' => 'Emma Swan',                     'order' => 2],
            ['series_id' => 15, 'actor_id' => 45, 'character_name' => 'La Méchante Reine / Regina',    'order' => 3],
            ['series_id' => 15, 'actor_id' => 46, 'character_name' => 'Rumplestiltskin / M. Gold',     'order' => 4],
        ];

        DB::table('series_actors')->insert($seriesActors);
    }
}
