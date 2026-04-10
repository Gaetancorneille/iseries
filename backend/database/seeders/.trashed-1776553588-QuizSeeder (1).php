<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    private function insertQuiz(string $title, string $description, ?int $seriesId, int $timeLimit, int $passingScore): int
    {
        return DB::table('quizzes')->insertGetId([
            'title'        => $title,
            'description'  => $description,
            'series_id'    => $seriesId,
            'created_by'   => 1,
            'time_limit'   => $timeLimit,
            'passing_score'=> $passingScore,
            'is_active'    => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }

    private function insertQuestions(int $quizId, array $questions): void
    {
        foreach ($questions as $i => $q) {
            DB::table('quiz_questions')->insert([
                'quiz_id'        => $quizId,
                'question'       => $q['question'],
                'options'        => json_encode($q['options']),
                'correct_answer' => $q['correct'],
                'points'         => 10,
                'explanation'    => $q['explanation'],
                'order'          => $i + 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }

    public function run()
    {
        // ── Quiz Breaking Bad (série 1) ───────────────────────────────────────
        $q1 = $this->insertQuiz('Quiz Breaking Bad', 'Testez vos connaissances sur Breaking Bad !', 1, 15, 70);
        $this->insertQuestions($q1, [
            ['question' => 'Quel est le nom de code de Walter White ?', 'options' => ['Heisenberg', 'Saul', 'Gus', 'Mike'], 'correct' => 'Heisenberg', 'explanation' => 'Walter White prend le nom d\'Heisenberg en référence au physicien Werner Heisenberg.'],
            ['question' => 'Quelle maladie Walter White découvre-t-il ?', 'options' => ['Cancer du poumon', 'Leucémie', 'Cancer du pancréas', 'Diabète'], 'correct' => 'Cancer du poumon', 'explanation' => 'Walter apprend qu\'il a un cancer du poumon inopérable en début de série.'],
            ['question' => 'Quelle couleur est associée au crystal meth de Walter ?', 'options' => ['Bleu', 'Vert', 'Rouge', 'Jaune'], 'correct' => 'Bleu', 'explanation' => 'Le crystal meth de Heisenberg est bleu en raison de sa pureté exceptionnelle.'],
            ['question' => 'Qui est Saul Goodman dans la série ?', 'options' => ['L\'avocat de Walter', 'Le dealer de Jesse', 'L\'ennemi de Gus', 'Le beau-frère de Walter'], 'correct' => 'L\'avocat de Walter', 'explanation' => 'Saul Goodman est l\'avocat véreux qui devient indispensable à Walter et Jesse.'],
            ['question' => 'Comment s\'appelle le restaurant de Gus Fring ?', 'options' => ['Los Pollos Hermanos', 'Casa Tranquila', 'Madrigal', 'El Camino'], 'correct' => 'Los Pollos Hermanos', 'explanation' => 'Los Pollos Hermanos est la façade légale de l\'empire de drogue de Gus Fring.'],
        ]);

        // ── Quiz Friends (série 8) ─────────────────────────────────────────────
        $q2 = $this->insertQuiz('Quiz Friends', 'Êtes-vous un vrai fan de Friends ?', 8, 12, 60);
        $this->insertQuestions($q2, [
            ['question' => 'Dans quel café se retrouvent les amis ?', 'options' => ['Central Perk', 'Coffee House', 'The Brew', 'Java Joe'], 'correct' => 'Central Perk', 'explanation' => 'Central Perk est le café iconique de Friends où les personnages se retrouvent.'],
            ['question' => 'Quelle est la phrase culte de Joey Tribbiani ?', 'options' => ['How you doin\'?', 'We were on a break!', 'Could this BE any more...', 'Oh. My. God.'], 'correct' => 'How you doin\'?', 'explanation' => 'Joey utilise toujours cette phrase pour séduire les femmes.'],
            ['question' => 'Combien de fois Ross a-t-il été marié ?', 'options' => ['3 fois', '2 fois', '4 fois', '1 fois'], 'correct' => '3 fois', 'explanation' => 'Ross a été marié à Carol, Emily et Rachel.'],
            ['question' => 'Quel est le métier de Chandler Bing ?', 'options' => ['IT procurement manager', 'Comptable', 'Avocat', 'Chef cuisinier'], 'correct' => 'IT procurement manager', 'explanation' => 'Chandler travaille dans le domaine de la gestion des ressources IT, un métier que personne ne comprend vraiment dans la série.'],
            ['question' => 'Comment s\'appellent les jumeaux de Phoebe à la fin ?', 'options' => ['Les enfants de Frank Jr.', 'Emma et Jack', 'Ben et Leslie', 'Ross et Monica'], 'correct' => 'Les enfants de Frank Jr.', 'explanation' => 'Phoebe a été mère porteuse pour son frère Frank Jr. et a porté ses triplés.'],
        ]);

        // ── Quiz Charmed (série 6) ────────────────────────────────────────────
        $q3 = $this->insertQuiz('Quiz Charmed', 'Connaissez-vous bien les sœurs Halliwell ?', 6, 10, 60);
        $this->insertQuestions($q3, [
            ['question' => 'Quel est le pouvoir de Phoebe Halliwell ?', 'options' => ['Prémonition', 'Arrêter le temps', 'Télékinésie', 'Lévitation seulement'], 'correct' => 'Prémonition', 'explanation' => 'Phoebe peut avoir des prémonitions en touchant des objets ou des personnes.'],
            ['question' => 'Comment s\'appelle le livre des sorcières ?', 'options' => ['Le Livre des Ombres', 'Le Grimoire', 'L\'Ancien Codex', 'Le Livre de Magie'], 'correct' => 'Le Livre des Ombres', 'explanation' => 'Le Livre des Ombres est transmis de génération en génération dans la famille Halliwell.'],
            ['question' => 'Qui remplace Prue Halliwell dans la série ?', 'options' => ['Paige Matthews', 'Billie Jenkins', 'Darryl Morris', 'Leo Wyatt'], 'correct' => 'Paige Matthews', 'explanation' => 'Paige Matthews, demi-sœur des Halliwell, arrive en saison 4 après le départ de Shannen Doherty.'],
            ['question' => 'Quel est le pouvoir de Piper Halliwell ?', 'options' => ['Geler le temps', 'Lancer des éclairs', 'Invisibilité', 'Lire les pensées'], 'correct' => 'Geler le temps', 'explanation' => 'Piper peut geler le temps autour d\'elle pour immobiliser ses ennemis.'],
        ]);

        // ── Quiz The Big Bang Theory (série 7) ────────────────────────────────
        $q4 = $this->insertQuiz('Quiz The Big Bang Theory', 'Êtes-vous aussi intelligent que Sheldon ?', 7, 12, 65);
        $this->insertQuestions($q4, [
            ['question' => 'Quelle est la spécialité de Sheldon Cooper ?', 'options' => ['Physique théorique', 'Astrophysique', 'Ingénierie', 'Biologie'], 'correct' => 'Physique théorique', 'explanation' => 'Sheldon Cooper est physicien théoricien spécialisé dans la théorie des cordes.'],
            ['question' => 'Que signifie "Bazinga" dans la série ?', 'options' => ['C\'est une blague !', 'Bonjour', 'Je t\'aime', 'Au revoir'], 'correct' => 'C\'est une blague !', 'explanation' => 'Sheldon utilise "Bazinga" pour signaler qu\'il vient de faire une blague.'],
            ['question' => 'Dans quel appartement vivent Sheldon et Leonard ?', 'options' => ['Appartement 4A', 'Appartement 3B', 'Appartement 2C', 'Appartement 5D'], 'correct' => 'Appartement 4A', 'explanation' => 'Sheldon et Leonard habitent l\'appartement 4A dans leur immeuble à Pasadena.'],
            ['question' => 'Quelle université emploie les personnages principaux ?', 'options' => ['Caltech', 'MIT', 'Harvard', 'Stanford'], 'correct' => 'Caltech', 'explanation' => 'Les personnages travaillent au California Institute of Technology (Caltech).'],
        ]);

        // ── Quiz Mercredi (série 10) ──────────────────────────────────────────
        $q5 = $this->insertQuiz('Quiz Mercredi', 'Tout savoir sur Mercredi Addams et l\'académie Nevermore', 10, 10, 60);
        $this->insertQuestions($q5, [
            ['question' => 'Dans quelle ville se situe l\'académie Nevermore ?', 'options' => ['Jericho', 'Salem', 'Greendale', 'Mystic Falls'], 'correct' => 'Jericho', 'explanation' => 'L\'académie Nevermore est située près de la ville de Jericho.'],
            ['question' => 'Quel est le pouvoir particulier de Mercredi ?', 'options' => ['Visions psychiques', 'Télékinésie', 'Invisibilité', 'Contrôle du feu'], 'correct' => 'Visions psychiques', 'explanation' => 'Mercredi a des visions psychiques du passé qu\'elle ne maîtrise pas encore.'],
            ['question' => 'Qui joue le rôle de Morticia Addams dans la série ?', 'options' => ['Catherine Zeta-Jones', 'Angelina Jolie', 'Monica Bellucci', 'Eva Green'], 'correct' => 'Catherine Zeta-Jones', 'explanation' => 'Catherine Zeta-Jones interprète Morticia Addams, la mère de Mercredi.'],
            ['question' => 'Comment s\'appelle la camarade de chambre de Mercredi ?', 'options' => ['Enid Sinclair', 'Bianca Barclay', 'Ajax', 'Yoko'], 'correct' => 'Enid Sinclair', 'explanation' => 'Enid Sinclair, une licanthrope optimiste, devient la meilleure amie de Mercredi.'],
        ]);

        // ── Quiz Suits (série 11) ─────────────────────────────────────────────
        $q6 = $this->insertQuiz('Quiz Suits', 'Connaissez-vous le cabinet Pearson Hardman ?', 11, 10, 65);
        $this->insertQuestions($q6, [
            ['question' => 'Dans quel cabinet travaille Harvey Specter ?', 'options' => ['Pearson Hardman', 'Pearson Specter Litt', 'Zane Associates', 'Specter & Ross'], 'correct' => 'Pearson Hardman', 'explanation' => 'Au début de la série, Harvey travaille au cabinet Pearson Hardman, qui changera plusieurs fois de nom.'],
            ['question' => 'Pourquoi Mike Ross n\'a-t-il pas de diplôme de droit ?', 'options' => ['Il a passé le barreau pour un ami', 'Il a été renvoyé', 'Il n\'a jamais étudié le droit', 'Son diplôme est falsifié'], 'correct' => 'Il a passé le barreau pour un ami', 'explanation' => 'Mike a passé le barreau à la place d\'un ami contre de l\'argent, ce qui l\'empêche d\'avoir son propre diplôme.'],
            ['question' => 'Quel est le surnom donné à Harvey Specter par ses pairs ?', 'options' => ['The Closer', 'The King', 'The Devil', 'The Best'], 'correct' => 'The Closer', 'explanation' => 'Harvey Specter est surnommé "the best closer in New York City".'],
        ]);

        // ── Quiz Scandal (série 12) ───────────────────────────────────────────
        $q7 = $this->insertQuiz('Quiz Scandal', 'Êtes-vous un gladiateur d\'Olivia Pope ?', 12, 10, 60);
        $this->insertQuestions($q7, [
            ['question' => 'Comment s\'appelle l\'agence d\'Olivia Pope ?', 'options' => ['Olivia Pope & Associates', 'Pope & Partners', 'The Gladiators', 'OPA Strategy'], 'correct' => 'Olivia Pope & Associates', 'explanation' => 'Olivia dirige le cabinet de gestion de crise Olivia Pope & Associates.'],
            ['question' => 'Quelle est la boisson fétiche d\'Olivia Pope ?', 'options' => ['Vin rouge', 'Champagne', 'Whisky', 'Café noir'], 'correct' => 'Vin rouge', 'explanation' => 'Olivia Pope est toujours montrée avec un grand verre de vin rouge, devenu son accessoire signature.'],
            ['question' => 'Quel est le nom de code de l\'organisation secrète dans la série ?', 'options' => ['B613', 'Albatross', 'Phoenix', 'Shadow'], 'correct' => 'B613', 'explanation' => 'B613 est l\'organisation gouvernementale secrète qui opère en dehors de toute loi.'],
        ]);

        // ── Quiz The Vampire Diaries (série 14) ───────────────────────────────
        $q8 = $this->insertQuiz('Quiz The Vampire Diaries', 'Connaissez-vous Mystic Falls sur le bout des doigts ?', 14, 12, 65);
        $this->insertQuestions($q8, [
            ['question' => 'Dans quelle ville se déroule la série ?', 'options' => ['Mystic Falls', 'Storybrooke', 'Jericho', 'Beacon Hills'], 'correct' => 'Mystic Falls', 'explanation' => 'Mystic Falls est une petite ville de Virginie où se déroulent tous les événements de la série.'],
            ['question' => 'Depuis combien de siècles les frères Salvatore sont-ils vampires ?', 'options' => ['145 ans', '100 ans', '200 ans', '500 ans'], 'correct' => '145 ans', 'explanation' => 'Stefan et Damon ont été transformés en vampires en 1864, soit environ 145 ans avant les événements de la série.'],
            ['question' => 'Qui a transformé Stefan et Damon en vampires ?', 'options' => ['Katherine Pierce', 'Elena Gilbert', 'Rebekah Mikaelson', 'Silas'], 'correct' => 'Katherine Pierce', 'explanation' => 'Katherine Pierce (alias Katerina Petrova) est à l\'origine de la transformation des frères Salvatore.'],
            ['question' => 'Qu\'est-ce qu\'une "doppelgänger" dans la série ?', 'options' => ['Un sosie magique', 'Un vampire ancien', 'Un loup-garou', 'Un sorcier'], 'correct' => 'Un sosie magique', 'explanation' => 'Elena est le doppelgänger de Katherine Pierce, une réplique magique qui apparaît à travers les générations.'],
        ]);

        // ── Quiz Once Upon a Time (série 15) ──────────────────────────────────
        $q9 = $this->insertQuiz('Quiz Once Upon a Time', 'Reconnaissez-vous les contes cachés à Storybrooke ?', 15, 12, 60);
        $this->insertQuestions($q9, [
            ['question' => 'Qui est le vrai père d\'Henry Mills ?', 'options' => ['Neal Cassidy / Baelfire', 'Le Prince Charmant', 'Rumplestiltskin', 'Graham'], 'correct' => 'Neal Cassidy / Baelfire', 'explanation' => 'Neal Cassidy, aussi connu sous le nom de Baelfire, est le vrai père d\'Henry.'],
            ['question' => 'Quel personnage de conte est Regina Mills dans son autre vie ?', 'options' => ['La Méchante Reine', 'La Sorcière', 'Cendrillon', 'La Belle au Bois Dormant'], 'correct' => 'La Méchante Reine', 'explanation' => 'Regina Mills est la Méchante Reine du conte de Blanche-Neige.'],
            ['question' => 'Quel objet symbolise le pouvoir de Rumplestiltskin ?', 'options' => ['Son poignard', 'Sa cape', 'Son anneau', 'Son livre de sorts'], 'correct' => 'Son poignard', 'explanation' => 'Le poignard de Rumplestiltskin porte son vrai nom et peut le contrôler ou le tuer.'],
            ['question' => 'Qui lance la malédiction sur Storybrooke ?', 'options' => ['La Méchante Reine', 'Rumplestiltskin', 'Cora', 'La Fée Clochette'], 'correct' => 'La Méchante Reine', 'explanation' => 'C\'est Regina, la Méchante Reine, qui lance la malédiction qui transporte tous les personnages à Storybrooke.'],
        ]);

        // ── Quiz général (toutes séries) ──────────────────────────────────────
        $q10 = $this->insertQuiz('Quiz Culture Séries', 'Testez vos connaissances sur toutes nos séries !', null, 20, 60);
        $this->insertQuestions($q10, [
            ['question' => 'Dans quelle série trouve-t-on le personnage Olivia Pope ?', 'options' => ['Scandal', 'Suits', 'Bones', 'Grey\'s Anatomy'], 'correct' => 'Scandal', 'explanation' => 'Olivia Pope est la protagoniste de la série Scandal, créée par Shonda Rhimes.'],
            ['question' => 'Quelle série se déroule à l\'académie Nevermore ?', 'options' => ['Mercredi', 'Once Upon a Time', 'Charmed', 'The Vampire Diaries'], 'correct' => 'Mercredi', 'explanation' => 'L\'académie Nevermore est au cœur de la série Mercredi sur Netflix.'],
            ['question' => 'Qui joue Fran Fine dans Une Nounou d\'Enfer ?', 'options' => ['Fran Drescher', 'Jennifer Aniston', 'Alyssa Milano', 'Courteney Cox'], 'correct' => 'Fran Drescher', 'explanation' => 'Fran Drescher incarne Fran Fine dans la série Une Nounou d\'Enfer.'],
            ['question' => 'Dans quelle ville se situe le cabinet d\'Harvey Specter ?', 'options' => ['New York', 'Los Angeles', 'Chicago', 'Washington D.C.'], 'correct' => 'New York', 'explanation' => 'Le cabinet Pearson Hardman (puis Pearson Specter Litt) est situé à New York.'],
            ['question' => 'Quelle actrice joue à la fois Elena et Katherine dans TVD ?', 'options' => ['Nina Dobrev', 'Candice King', 'Kat Graham', 'Claire Holt'], 'correct' => 'Nina Dobrev', 'explanation' => 'Nina Dobrev incarne à la fois Elena Gilbert et son doppelgänger Katherine Pierce.'],
            ['question' => 'Dans Friends, quel est le prénom du bébé de Ross et Rachel ?', 'options' => ['Emma', 'Sophie', 'Lily', 'Claire'], 'correct' => 'Emma', 'explanation' => 'Ross et Rachel nomment leur fille Emma, un prénom que Monica voulait garder pour elle.'],
        ]);
    }
}
