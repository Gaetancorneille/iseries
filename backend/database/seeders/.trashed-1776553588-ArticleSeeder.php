<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => 'Pourquoi Breaking Bad est considéré comme le meilleur téléfilm de tous les temps',
                'content' => 'Breaking Bad reste une référence inégalée dans l\'univers des séries télévisées. La transformation de Walter White d\'enseignant de chimie timide à chef de l\'empire du crystal meth est l\'un des arcs narratifs les plus impressionnants de l\'histoire de la télévision. Bryan Cranston livre une performance monumentale, soutenue par Aaron Paul dont l\'interprétation de Jesse Pinkman est à la fois touchante et profondément humaine.

Le série maîtrise l\'art de construire la tension dramatique à travers ses 62 épisodes, alliant suspense policier, drame familial et thriller moral. Chaque saison creuse davantage le fossé entre l\'homme honnête que Walter était au début et le terrorisant "Heisenberg" qu\'il devient.',
                'author_id' => 1,
                'series_id' => 1,
                'published_at' => now()->subDays(10),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Last of Us : L\'adaptation parfaite qui honore son jeu d\'origine',
                'content' => 'HBO a réussi l\'exploit rare de créer une série d\'une fidélité exceptionnelle à son jeu d\'origine. La chimie entre Pedro Pascal et Bella Ramsey capture parfaitement l\'essence de la relation père-fille post-apocalyptique. Neil Druckmann et Craig Mazin ont su transformer brillamment le medium du jeu vidéo en un format sérialisé tout en conservant l\'intensité émotionnelle de l\'aventure originale.

L\'atmosphère oppressante post-Cordyceps et la réalisation visuelle impressionnante transforment les Ennemis parfaits de la bédé interactive en expériences télévisuelles saisissantes. Chaque épisode fait référence à la souche de champignons, maintenant les tensions toujours au plus haut.',
                'author_id' => 2,
                'series_id' => 3,
                'published_at' => now()->subDays(5),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'La Renaissance des séries en continu : le futur de la fiction',
                'content' => 'L\'ère moderne des plateformes de streaming a révolutionné la façon dont nous consommons les séries télévisées. Des expériences de consommation immédiatement éducatives sur la longévité de franchises aux incertitudes frénétiques de la résolution, cette nouvelle donne méritocratique façonne l\'imaginaire culturel avec plus de répercussion.

Netflix, Prime Video, HBO Max et les autres plates-formes du passé convergent progressivement pour cimenter cet apport visionnaire, produisant d\'intarissables ouvres désormais passées au laboratoire pilulier mérite-ocratique sur la nature pure, qui souci immédiatise constance de la recherche, mais sa future cohérence structuro-psyché-en-profonde.',
                'author_id' => 3,
                'series_id' => null,
                'published_at' => now()->subDays(3),
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('articles')->insert($articles);
    }
}