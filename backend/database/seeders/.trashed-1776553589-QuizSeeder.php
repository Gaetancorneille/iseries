<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Create sample quizzes
        $quiz1 = DB::table('quizzes')->insertGetId([
            'title' => 'Quiz sur Breaking Bad',
            'description' => 'Testez vos connaissances sur la série Breaking Bad',
            'series_id' => 1,
            'created_by' => 1,
            'time_limit' => 15,
            'passing_score' => 70,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $quiz2 = DB::table('quizzes')->insertGetId([
            'title' => 'Quiz général sur les séries',
            'description' => 'Un quiz pour tester vos connaissances générales sur les séries télévisées',
            'series_id' => null,
            'created_by' => 1,
            'time_limit' => 20,
            'passing_score' => 60,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Questions for Breaking Bad quiz
        $breakingBadQuestions = [
            [
                'quiz_id' => $quiz1,
                'question' => 'Quel est le nom de code de Walter White dans la série ?',
                'options' => json_encode(['Heisenberg', 'Saul Goodman', 'Gus Fring', 'Mike Ehrmantraut']),
                'correct_answer' => 'Heisenberg',
                'points' => 10,
                'explanation' => 'Walter White utilise le nom de code "Heisenberg" inspiré du physicien allemand Werner Heisenberg.',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz1,
                'question' => 'Quelle maladie Walter White découvre-t-il au début de la série ?',
                'options' => json_encode(['Cancer du poumon', 'Cancer de la prostate', 'Leucémie', 'Cancer du pancréas']),
                'correct_answer' => 'Cancer du poumon',
                'points' => 10,
                'explanation' => 'Walter White découvre qu\'il a un cancer du poumon inopérable au début de la série.',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz1,
                'question' => 'Quel est le prénom du fils de Walter White ?',
                'options' => json_encode(['Walter Jr.', 'Flynn', 'Louis', 'Marie']),
                'correct_answer' => 'Flynn',
                'points' => 10,
                'explanation' => 'Le fils de Walter White s\'appelle Flynn, bien qu\'il soit souvent appelé Walter Jr.',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz1,
                'question' => 'Quelle est la profession de Jesse Pinkman ?',
                'options' => json_encode(['Dealer de drogue', 'Enseignant de chimie', 'Avocat', 'Policier']),
                'correct_answer' => 'Dealer de drogue',
                'points' => 10,
                'explanation' => 'Jesse Pinkman est un dealer de drogue qui devient partenaire de Walter dans la fabrication de méthamphétamine.',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Questions for general quiz
        $generalQuestions = [
            [
                'quiz_id' => $quiz2,
                'question' => 'Dans quelle série trouve-t-on le personnage de Daenerys Targaryen ?',
                'options' => json_encode(['Game of Thrones', 'The Witcher', 'The Last Kingdom', 'Vikings']),
                'correct_answer' => 'Game of Thrones',
                'points' => 5,
                'explanation' => 'Daenerys Targaryen est l\'un des personnages principaux de Game of Thrones.',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz2,
                'question' => 'Quelle plateforme a produit The Last of Us ?',
                'options' => json_encode(['HBO', 'Netflix', 'Amazon Prime', 'Disney+']),
                'correct_answer' => 'HBO',
                'points' => 5,
                'explanation' => 'The Last of Us est une série produite par HBO, adaptée du jeu vidéo du même nom.',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz2,
                'question' => 'Dans quelle ville se déroule principalement Stranger Things ?',
                'options' => json_encode(['Hawkins', 'Springfield', 'Riverside', 'Greenville']),
                'correct_answer' => 'Hawkins',
                'points' => 5,
                'explanation' => 'Stranger Things se déroule principalement dans la ville fictive de Hawkins, dans l\'Indiana.',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => $quiz2,
                'question' => 'Qui joue le rôle principal dans The Mandalorian ?',
                'options' => json_encode(['Pedro Pascal', 'Oscar Isaac', 'Gina Carano', 'Carl Weathers']),
                'correct_answer' => 'Pedro Pascal',
                'points' => 5,
                'explanation' => 'Pedro Pascal joue le rôle principal du Mandalorien dans la série Star Wars.',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('quiz_questions')->insert(array_merge($breakingBadQuestions, $generalQuestions));
    }
}