<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        $seasons = [
            // Breaking Bad (ID 1) — 5 saisons
            ['series_id' => 1, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Walter découvre sa maladie et fait ses premiers pas dans le trafic.', 'release_date' => '2008-01-20', 'episode_count' => 7],
            ['series_id' => 1, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'L\'empire de Walter et Jesse se développe dangereusement.', 'release_date' => '2009-03-08', 'episode_count' => 13],
            ['series_id' => 1, 'season_number' => 3, 'title' => 'Saison 3', 'description' => 'Gus Fring entre en scène et change tout.', 'release_date' => '2010-03-21', 'episode_count' => 13],
            ['series_id' => 1, 'season_number' => 4, 'title' => 'Saison 4', 'description' => 'La guerre froide entre Walter et Gus.', 'release_date' => '2011-07-17', 'episode_count' => 13],
            ['series_id' => 1, 'season_number' => 5, 'title' => 'Saison 5', 'description' => 'Le dénouement tragique et inévitable.', 'release_date' => '2012-07-15', 'episode_count' => 16],

            // Game of Thrones (ID 2) — 2 saisons
            ['series_id' => 2, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Les grandes familles entrent en guerre pour le Trône de Fer.', 'release_date' => '2011-04-17', 'episode_count' => 10],
            ['series_id' => 2, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'La guerre des Cinq Rois déchire Westeros.', 'release_date' => '2012-04-01', 'episode_count' => 10],

            // The Last of Us (ID 3) — 1 saison
            ['series_id' => 3, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Le voyage de Joel et Ellie à travers un monde dévasté.', 'release_date' => '2023-01-15', 'episode_count' => 9],

            // Charmed (ID 6) — 2 saisons
            ['series_id' => 6, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Les sœurs Halliwell découvrent leurs pouvoirs de sorcières.', 'release_date' => '1998-10-07', 'episode_count' => 22],
            ['series_id' => 6, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'Les Charmed One affrontent de nouvelles forces démoniaques.', 'release_date' => '1999-09-30', 'episode_count' => 22],

            // The Big Bang Theory (ID 7) — 2 saisons
            ['series_id' => 7, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Sheldon, Leonard et leurs amis rencontrent Penny.', 'release_date' => '2007-09-24', 'episode_count' => 17],
            ['series_id' => 7, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'Les relations se compliquent, surtout entre Leonard et Penny.', 'release_date' => '2008-09-22', 'episode_count' => 23],

            // Friends (ID 8) — 2 saisons
            ['series_id' => 8, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Rachel fuit son mariage et rejoint le groupe d\'amis à Central Perk.', 'release_date' => '1994-09-22', 'episode_count' => 24],
            ['series_id' => 8, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'Ross et Rachel, la romance la plus compliquée de New York.', 'release_date' => '1995-09-21', 'episode_count' => 24],

            // Une Nounou d'Enfer (ID 9) — 1 saison
            ['series_id' => 9, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Fran Fine débarque chez les Sheffield et bouleverse tout.', 'release_date' => '1993-11-03', 'episode_count' => 22],

            // Mercredi (ID 10) — 1 saison
            ['series_id' => 10, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Mercredi Addams arrive à l\'académie Nevermore et enquête sur des meurtres mystérieux.', 'release_date' => '2022-11-23', 'episode_count' => 8],

            // Suits (ID 11) — 2 saisons
            ['series_id' => 11, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Harvey engage Mike, un génie sans diplôme, dans le cabinet Pearson Hardman.', 'release_date' => '2011-06-23', 'episode_count' => 12],
            ['series_id' => 11, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'Harvey et Mike font face à une menace interne au cabinet.', 'release_date' => '2012-06-14', 'episode_count' => 16],

            // Scandal (ID 12) — 1 saison
            ['series_id' => 12, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Olivia Pope gère ses premiers scandales à Washington.', 'release_date' => '2012-04-05', 'episode_count' => 7],

            // Bones (ID 13) — 2 saisons
            ['series_id' => 13, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Bones et Booth forment leur duo improbable pour résoudre des affaires criminelles.', 'release_date' => '2005-09-13', 'episode_count' => 22],
            ['series_id' => 13, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'De nouveaux mystères et une relation qui évolue entre Bones et Booth.', 'release_date' => '2006-08-30', 'episode_count' => 21],

            // The Vampire Diaries (ID 14) — 2 saisons
            ['series_id' => 14, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Elena rencontre Stefan et découvre que Mystic Falls cache de sombres secrets.', 'release_date' => '2009-09-10', 'episode_count' => 22],
            ['series_id' => 14, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'L\'arrivée de Katherine Pierce bouleverse la vie de Stefan et Damon.', 'release_date' => '2010-09-09', 'episode_count' => 22],

            // Once Upon a Time (ID 15) — 2 saisons
            ['series_id' => 15, 'season_number' => 1, 'title' => 'Saison 1', 'description' => 'Emma Swan arrive à Storybrooke et commence à lever le voile sur la malédiction.', 'release_date' => '2011-10-23', 'episode_count' => 22],
            ['series_id' => 15, 'season_number' => 2, 'title' => 'Saison 2', 'description' => 'La malédiction est levée mais les personnages de contes n\'ont pas retrouvé leur monde.', 'release_date' => '2012-09-30', 'episode_count' => 22],
        ];

        foreach ($seasons as &$s) {
            $s['created_at'] = now();
            $s['updated_at'] = now();
        }

        DB::table('seasons')->insert($seasons);
    }
}
