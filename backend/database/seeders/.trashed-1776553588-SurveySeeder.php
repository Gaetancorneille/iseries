<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySeeder extends Seeder
{
    public function run()
    {
        // Create sample surveys
        $survey = DB::table('surveys')->insertGetId([
            'title' => 'Quelle est votre série préférée de tous les temps ?',
            'description' => 'Participez à notre sondage pour déterminer quelle série a marqué l\'histoire de la télévision',
            'created_by' => 1,
            'is_active' => true,
            'starts_at' => now(),
            'ends_at' => now()->addMonths(1),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create survey questions
        $questions = [
            [
                'survey_id' => $survey,
                'question' => 'Quelle série préférez-vous ?',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'Breaking Bad',
                    'Game of Thrones',
                    'The Last of Us',
                    'Stranger Things',
                    'The Mandalorian',
                    'Autre'
                ]),
                'is_required' => true,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'survey_id' => $survey,
                'question' => 'Quel genre de série regardez-vous le plus ?',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'Drame',
                    'Science-fiction',
                    'Fantastique',
                    'Policier',
                    'Comédie',
                    'Documentaire'
                ]),
                'is_required' => true,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'survey_id' => $survey,
                'question' => 'Quelle plateforme de streaming utilisez-vous le plus ?',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'Netflix',
                    'Prime Video',
                    'Disney+',
                    'HBO Max',
                    'OCS',
                    'Autre'
                ]),
                'is_required' => true,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'survey_id' => $survey,
                'question' => 'Qu\'est-ce qui vous attire le plus dans une série ?',
                'type' => 'multiple_choice',
                'options' => json_encode([
                    'L\'histoire et le scénario',
                    'Les acteurs et les performances',
                    'La réalisation et la mise en scène',
                    'Les effets spéciaux',
                    'L\'ambiance et la musique',
                    'La durée des épisodes'
                ]),
                'is_required' => true,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('survey_questions')->insert($questions);
    }
}