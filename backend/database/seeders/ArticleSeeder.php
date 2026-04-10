<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            // ── Breaking Bad ──────────────────────────────────────────────────
            [
                'title'        => 'Pourquoi Breaking Bad reste la meilleure série de tous les temps',
                'content'      => "Breaking Bad demeure une référence inégalée dans l'univers des séries télévisées. La transformation de Walter White d'enseignant de chimie timide à chef d'un empire criminel est l'un des arcs narratifs les plus impressionnants de l'histoire de la télévision.\n\nBryan Cranston livre une performance monumentale, soutenue par Aaron Paul dont l'interprétation de Jesse Pinkman est à la fois touchante et profondément humaine. Chaque saison creuse davantage le fossé entre l'homme honnête que Walter était et le terrifiant Heisenberg qu'il devient.\n\nVince Gilligan a réussi l'exploit de rendre un protagoniste de plus en plus moralement ambigu attachant jusqu'au bout, grâce à une écriture rigoureuse et une maîtrise absolue de la tension dramatique.",
                'author_id'    => 1,
                'series_id'    => 1,
                'published_at' => now()->subDays(30),
                'is_featured'  => true,
            ],
            // ── Charmed ───────────────────────────────────────────────────────
            [
                'title'        => 'Charmed : le féminisme avant l\'heure dans une série fantastique',
                'content'      => "Charmed, diffusée de 1998 à 2006, est bien plus qu'une simple série fantastique. En mettant trois sœurs au cœur de l'action, les showrunners ont créé l'une des premières représentations fortes de femmes indépendantes et puissantes à la télévision américaine.\n\nLes sœurs Halliwell — Prue, Piper, Phoebe, puis Paige — n'attendaient pas qu'on vienne les sauver. Elles géraient des carrières, des relations amoureuses et des démons avec la même énergie. La dynamique entre les quatre actrices, notamment Alyssa Milano et Holly Marie Combs, reste l'un des points forts de la série.\n\nMalgré des effets spéciaux qui datent, l'héritage de Charmed sur les séries fantastiques modernes est indéniable.",
                'author_id'    => 2,
                'series_id'    => 6,
                'published_at' => now()->subDays(25),
                'is_featured'  => true,
            ],
            // ── The Big Bang Theory ───────────────────────────────────────────
            [
                'title'        => 'Sheldon Cooper : personnage de comédie ou portrait de génie incompris ?',
                'content'      => "Sheldon Cooper, incarné magistralement par Jim Parsons, est devenu l'un des personnages de fiction les plus populaires de la décennie 2007-2019. Mais derrière les gags sur la théorie des cordes et les règles de cohabitation se cache un personnage d'une richesse insoupçonnée.\n\nThe Big Bang Theory a eu le mérite de mettre des scientifiques, des geeks et des passionnés de culture pop au premier plan dans une comédie grand public. Si la série a parfois été critiquée pour son rapport ambigu avec la culture nerd, son succès planétaire de 12 saisons témoigne d'un vrai phénomène culturel.\n\nLe départ de Jim Parsons pour la saison finale reste l'une des décisions les plus discutées de la télévision récente.",
                'author_id'    => 3,
                'series_id'    => 7,
                'published_at' => now()->subDays(22),
                'is_featured'  => false,
            ],
            // ── Friends ───────────────────────────────────────────────────────
            [
                'title'        => 'Friends : 30 ans après, pourquoi la série reste intemporelle',
                'content'      => "En 2024, Friends fête ses 30 ans et n'a jamais semblé aussi actuel. La série suit six amis trentenaires à New York et a défini ce que signifie une comédie de situation moderne.\n\nJennifer Aniston, Courteney Cox, Lisa Kudrow, Matt LeBlanc, Matthew Perry et David Schwimmer ont créé une alchimie rare que peu de séries ont su reproduire depuis. Chaque personnage incarne un archétype : la romantique, la perfectionniste, la fantaisiste, le beau gosse, le sarcastique, le savant.\n\nLa mort de Matthew Perry en 2023 a ravivé l'amour mondial pour la série. Chandler Bing restera l'un des personnages comiques les plus aimés de l'histoire de la télévision.",
                'author_id'    => 1,
                'series_id'    => 8,
                'published_at' => now()->subDays(18),
                'is_featured'  => true,
            ],
            // ── Mercredi ──────────────────────────────────────────────────────
            [
                'title'        => 'Mercredi : comment Jenna Ortega a réinventé une icône culte',
                'content'      => "Quand Netflix a annoncé une série centrée sur Mercredi Addams, les fans de la famille Addams étaient partagés. Mais Jenna Ortega a réussi l'impossible : s'approprier un personnage iconique tout en lui donnant une vie entièrement nouvelle.\n\nLa série de Tim Burton mêle habilement enquête surnaturelle, comédie noire et teen drama. L'académie Nevermore est un écrin parfait pour les aventures de cette jeune sorcière asociale qui n'a de cesse de résoudre des meurtres mystérieux.\n\nJenna Ortega, à seulement 20 ans au moment du tournage, porte l'intégralité de la série sur ses épaules avec une présence écrasante. Sa danse virale au bal masqué reste l'un des moments télévisés les plus partagés de 2022.",
                'author_id'    => 2,
                'series_id'    => 10,
                'published_at' => now()->subDays(15),
                'is_featured'  => true,
            ],
            // ── Suits ─────────────────────────────────────────────────────────
            [
                'title'        => 'Suits : la série juridique qui a tout changé au genre',
                'content'      => "Suits a débarqué en 2011 comme une simple série juridique et s'est transformée en phénomène de mode et de culture pop. L'alliance entre Harvey Specter, l'avocat implacable de Gabriel Macht, et Mike Ross, le génie sans diplôme de Patrick J. Adams, est l'une des bromances les plus solides de la télévision.\n\nLa série a aussi propulsé Meghan Markle sous les feux des projecteurs bien avant qu'elle ne devienne Duchesse de Sussex. Son personnage de Rachel Zane, intelligente et déterminée, est resté dans les mémoires.\n\nDepuis sa redécouverte sur Netflix en 2023, Suits a battu tous les records de streaming, prouvant que son écriture vive et ses dialogues percutants ont traversé le temps.",
                'author_id'    => 3,
                'series_id'    => 11,
                'published_at' => now()->subDays(12),
                'is_featured'  => false,
            ],
            // ── The Vampire Diaries ───────────────────────────────────────────
            [
                'title'        => 'Damon vs Stefan : le débat qui a divisé une génération de fans',
                'content'      => "The Vampire Diaries a créé l'un des triangles amoureux les plus passionnés de la télévision avec Elena, Stefan et Damon. Pendant 8 saisons, les fans ont été coupés en deux : Team Stefan ou Team Damon ?\n\nIan Somerhalder a volé la vedette avec un Damon Salvatore dont l'évolution de villain charismatique à anti-héros complexe est l'un des meilleurs arcs de transformation de la série. Paul Wesley lui a offert un contrepoint parfait avec un Stefan plus noble mais aussi plus torturé.\n\nNina Dobrev, en incarnant à la fois Elena et Katherine, a montré une polyvalence impressionnante. La série reste une référence du genre vampire romantique et a ouvert la voie à de nombreuses autres.",
                'author_id'    => 1,
                'series_id'    => 14,
                'published_at' => now()->subDays(8),
                'is_featured'  => false,
            ],
            // ── Once Upon a Time ─────────────────────────────────────────────
            [
                'title'        => 'Once Upon a Time : contes de fées, trahisons et rédemption',
                'content'      => "Once Upon a Time a eu l'audace de prendre tous les personnages de contes que nous connaissons depuis l'enfance et de les projeter dans le monde réel, amnésiques et perdus dans une petite ville du Maine.\n\nL'idée de départ est géniale : et si Blanche-Neige était institutrice ? Si Rumplestiltskin était un antiquaire ? Ginnifer Goodwin et Lana Parrilla portent la série avec une élégance rare, leur rivalité écran étant l'un des moteurs dramatiques les plus solides de la série.\n\nRobert Carlyle en Rumplestiltskin est tout simplement inoubliable : un personnage dont chaque couche révèle une nouvelle complexité morale. Once Upon a Time reste une des séries les plus originales de la décennie 2010.",
                'author_id'    => 2,
                'series_id'    => 15,
                'published_at' => now()->subDays(5),
                'is_featured'  => true,
            ],
            // ── Scandal ───────────────────────────────────────────────────────
            [
                'title'        => 'Kerry Washington et Scandal : quand la télévision devient politique',
                'content'      => "Scandal a marqué l'histoire de la télévision américaine en plaçant une femme noire au centre d'un thriller politique haletant. Kerry Washington incarne Olivia Pope avec une intensité rare, jonglant entre la gestion de crises pour les puissants et ses propres démons intérieurs.\n\nShonda Rhimes, la showrunner, a créé avec Scandal un univers où chaque personnage porte ses parts d'ombre. Le Président Grant, la CIA, le FBI, les gladiators d'Olivia : tout le monde a quelque chose à cacher à Washington.\n\nLa série a ouvert la voie à une nouvelle ère de drama politique à la télévision et a fait de Shonda Rhimes la productrice la plus puissante d'Hollywood.",
                'author_id'    => 3,
                'series_id'    => 12,
                'published_at' => now()->subDays(3),
                'is_featured'  => false,
            ],
            // ── Bones ─────────────────────────────────────────────────────────
            [
                'title'        => 'Bones : la science au service du crime, 12 saisons d\'excellence',
                'content'      => "Bones a tenu 12 saisons grâce à une formule simple mais redoutable : mettre en opposition deux personnages que tout sépare. Temperance Brennan, l'anthropologue hyper rationnelle jouée par Emily Deschanel, et Seeley Booth, le flic instinctif de David Boreanaz, forment l'un des duos les plus attachants de la télévision.\n\nLa série a réussi à intégrer la science forensique dans un format grand public sans jamais sacrifier le côté humain et émotionnel. L'équipe du Jeffersonian est devenue une vraie famille télévisuelle.\n\nBones a aussi réussi l'un des défis les plus difficiles : transformer une tension romantesque en couple officiel sans que la série ne perde de son intérêt. Leur histoire d'amour progressive est un modèle du genre.",
                'author_id'    => 1,
                'series_id'    => 13,
                'published_at' => now()->subDays(1),
                'is_featured'  => false,
            ],
        ];

        foreach ($articles as &$a) {
            $a['created_at'] = now();
            $a['updated_at'] = now();
        }

        DB::table('articles')->insert($articles);
    }
}
