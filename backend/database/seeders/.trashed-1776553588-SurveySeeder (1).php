<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurveySeeder extends Seeder
{
    private function insertSurvey(string $title, string $description, array $questions): void
    {
        $surveyId = DB::table('surveys')->insertGetId([
            'title'       => $title,
            'description' => $description,
            'created_by'  => 1,
            'is_active'   => true,
            'starts_at'   => now(),
            'ends_at'     => now()->addMonths(3),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        foreach ($questions as $i => $q) {
            DB::table('survey_questions')->insert([
                'survey_id'  => $surveyId,
                'question'   => $q['question'],
                'type'       => $q['type'],
                'options'    => isset($q['options']) ? json_encode($q['options']) : null,
                'is_required'=> true,
                'order'      => $i + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function run()
    {
        // ── Sondage 1 : Série préférée ────────────────────────────────────────
        $this->insertSurvey(
            'Votre série préférée parmi notre catalogue',
            'Dites-nous quelle série vous a le plus marqué parmi celles disponibles sur iSeries-TV.',
            [
                [
                    'question' => 'Quelle est votre série préférée de notre catalogue ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Breaking Bad', 'Friends', 'The Vampire Diaries', 'Charmed', 'Suits', 'Mercredi', 'Once Upon a Time', 'Bones', 'Scandal', 'The Big Bang Theory', 'Une Nounou d\'Enfer'],
                ],
                [
                    'question' => 'Quel genre de série regardez-vous le plus souvent ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Drame', 'Comédie', 'Fantastique / Surnaturel', 'Crime / Policier', 'Thriller', 'Romance'],
                ],
                [
                    'question' => 'Donnez une note générale à notre catalogue de séries',
                    'type'     => 'rating',
                ],
                [
                    'question' => 'Quelle série souhaiteriez-vous voir ajoutée à notre catalogue ?',
                    'type'     => 'text',
                ],
            ]
        );

        // ── Sondage 2 : Personnage préféré ────────────────────────────────────
        $this->insertSurvey(
            'Quel personnage féminin vous inspire le plus ?',
            'Les séries de notre catalogue regorgent de personnages féminins forts et inspirants. Lequel vous touche le plus ?',
            [
                [
                    'question' => 'Quel personnage féminin préférez-vous ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Olivia Pope (Scandal)', 'Piper Halliwell (Charmed)', 'Rachel Green (Friends)', 'Mercredi Addams (Mercredi)', 'Elena Gilbert (TVD)', 'Fran Fine (Une Nounou)', 'Temperance Brennan (Bones)', 'Emma Swan (Once Upon a Time)'],
                ],
                [
                    'question' => 'Qu\'est-ce qui vous attire le plus chez un personnage de série ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Sa force de caractère', 'Son humour', 'Son intelligence', 'Sa complexité morale', 'Sa vulnérabilité', 'Sa relation avec les autres'],
                ],
                [
                    'question' => 'En quelques mots, décrivez le personnage idéal de série TV',
                    'type'     => 'text',
                ],
            ]
        );

        // ── Sondage 3 : Habitudes de visionnage ───────────────────────────────
        $this->insertSurvey(
            'Vos habitudes de visionnage de séries',
            'Aidez-nous à mieux vous connaître pour améliorer votre expérience sur iSeries-TV.',
            [
                [
                    'question' => 'Combien d\'heures de séries regardez-vous par semaine ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Moins d\'1 heure', '1 à 3 heures', '3 à 7 heures', '7 à 15 heures', 'Plus de 15 heures'],
                ],
                [
                    'question' => 'Sur quelle plateforme regardez-vous le plus de séries ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Netflix', 'Prime Video', 'Disney+', 'Canal+', 'Téléchargement', 'Autre'],
                ],
                [
                    'question' => 'Regardez-vous les séries en version originale ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Toujours en VO', 'Souvent en VO', 'Parfois en VO', 'Toujours en VF'],
                ],
                [
                    'question' => 'Notez votre satisfaction sur iSeries-TV',
                    'type'     => 'rating',
                ],
                [
                    'question' => 'Que pourrions-nous améliorer sur iSeries-TV ?',
                    'type'     => 'text',
                ],
            ]
        );

        // ── Sondage 4 : Duo préféré ───────────────────────────────────────────
        $this->insertSurvey(
            'Le meilleur duo de série TV selon vous',
            'Séries, couples, duos d\'amis ou partenaires de travail : quel est le binôme que vous aimez le plus ?',
            [
                [
                    'question' => 'Quel est votre duo préféré dans notre catalogue ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['Bones & Booth (Bones)', 'Ross & Rachel (Friends)', 'Damon & Stefan (TVD)', 'Harvey & Mike (Suits)', 'Piper & Phoebe (Charmed)', 'Mercredi & Enid (Mercredi)', 'Olivia & Fitz (Scandal)', 'Emma & Regina (Once Upon a Time)'],
                ],
                [
                    'question' => 'Qu\'est-ce qui fait un grand duo dans une série ?',
                    'type'     => 'multiple_choice',
                    'options'  => ['La tension romantique non résolue', 'L\'humour et la complicité', 'Les opposés qui s\'attirent', 'L\'amitié profonde', 'La rivalité constructive'],
                ],
                [
                    'question' => 'Notez l\'importance des relations entre personnages dans votre appréciation d\'une série',
                    'type'     => 'rating',
                ],
            ]
        );
    }
}
