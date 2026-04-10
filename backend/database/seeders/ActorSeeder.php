<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActorSeeder extends Seeder
{
    public function run()
    {
        $actors = [
            // ── Acteurs existants (IDs 1-6) ─────────────────────────────────
            ['name' => 'Bryan Cranston',     'birth_date' => '1956-03-07', 'biography' => 'Acteur américain connu pour son rôle de Walter White dans Breaking Bad.', 'imdb_id' => 'nm0186505', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aaron Paul',         'birth_date' => '1979-08-27', 'biography' => 'Acteur américain, interprète de Jesse Pinkman dans Breaking Bad.', 'imdb_id' => 'nm0666739', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anna Gunn',          'birth_date' => '1968-08-11', 'biography' => 'Actrice américaine, Skyler White dans Breaking Bad.', 'imdb_id' => 'nm0348151', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Giancarlo Esposito', 'birth_date' => '1958-04-26', 'biography' => 'Acteur américain, connu pour son rôle de Gus Fring.', 'imdb_id' => 'nm0000158', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bella Ramsey',       'birth_date' => '2003-09-30', 'biography' => 'Actrice anglaise, Ellie dans The Last of Us.', 'imdb_id' => 'nm8165600', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pedro Pascal',       'birth_date' => '1975-04-02', 'biography' => 'Acteur chilien-américain, Joel dans The Last of Us et The Mandalorian.', 'imdb_id' => 'nm0050959', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Charmed (IDs 7-10) ───────────────────────────────────────────
            ['name' => 'Alyssa Milano',      'birth_date' => '1973-12-19', 'biography' => 'Actrice américaine, Phoebe Halliwell dans Charmed.', 'imdb_id' => 'nm0000297', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shannen Doherty',    'birth_date' => '1971-04-12', 'biography' => 'Actrice américaine, Prue Halliwell dans Charmed saisons 1-3.', 'imdb_id' => 'nm0000223', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Holly Marie Combs',  'birth_date' => '1973-12-03', 'biography' => 'Actrice américaine, Piper Halliwell dans Charmed.', 'imdb_id' => 'nm0173013', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rose McGowan',       'birth_date' => '1973-09-05', 'biography' => 'Actrice américaine, Paige Matthews dans Charmed saisons 4-8.', 'imdb_id' => 'nm0001527', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── The Big Bang Theory (IDs 11-15) ──────────────────────────────
            ['name' => 'Jim Parsons',        'birth_date' => '1973-03-24', 'biography' => 'Acteur américain, Sheldon Cooper dans The Big Bang Theory.', 'imdb_id' => 'nm0664856', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Johnny Galecki',     'birth_date' => '1975-04-30', 'biography' => 'Acteur américain, Leonard Hofstadter dans The Big Bang Theory.', 'imdb_id' => 'nm0002093', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kaley Cuoco',        'birth_date' => '1985-11-30', 'biography' => 'Actrice américaine, Penny dans The Big Bang Theory.', 'imdb_id' => 'nm0192912', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mayim Bialik',       'birth_date' => '1975-12-12', 'biography' => 'Actrice américaine, Amy Farrah Fowler dans The Big Bang Theory.', 'imdb_id' => 'nm0082010', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Melissa Rauch',      'birth_date' => '1980-06-23', 'biography' => 'Actrice américaine, Bernadette Rostenkowski dans The Big Bang Theory.', 'imdb_id' => 'nm1700426', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Friends (IDs 16-21) ───────────────────────────────────────────
            ['name' => 'Jennifer Aniston',   'birth_date' => '1969-02-11', 'biography' => 'Actrice américaine, Rachel Green dans Friends.', 'imdb_id' => 'nm0000098', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Courteney Cox',      'birth_date' => '1964-06-15', 'biography' => 'Actrice américaine, Monica Geller dans Friends.', 'imdb_id' => 'nm0001073', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lisa Kudrow',        'birth_date' => '1963-07-30', 'biography' => 'Actrice américaine, Phoebe Buffay dans Friends.', 'imdb_id' => 'nm0001435', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Matt LeBlanc',       'birth_date' => '1967-07-25', 'biography' => 'Acteur américain, Joey Tribbiani dans Friends.', 'imdb_id' => 'nm0001476', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Matthew Perry',      'birth_date' => '1969-08-19', 'biography' => 'Acteur canadien-américain, Chandler Bing dans Friends. Décédé en 2023.', 'imdb_id' => 'nm0675525', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'David Schwimmer',    'birth_date' => '1966-11-02', 'biography' => 'Acteur américain, Ross Geller dans Friends.', 'imdb_id' => 'nm0001718', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Une Nounou d'Enfer (IDs 22-25) ───────────────────────────────
            ['name' => 'Fran Drescher',      'birth_date' => '1957-09-30', 'biography' => 'Actrice américaine, Fran Fine dans Une Nounou d\'Enfer.', 'imdb_id' => 'nm0000345', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Charles Shaughnessy','birth_date' => '1955-02-09', 'biography' => 'Acteur britannique, Maxwell Sheffield dans Une Nounou d\'Enfer.', 'imdb_id' => 'nm0788187', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Daniel Davis',       'birth_date' => '1945-11-26', 'biography' => 'Acteur américain, Niles le majordome dans Une Nounou d\'Enfer.', 'imdb_id' => 'nm0203730', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lauren Lane',        'birth_date' => '1961-01-06', 'biography' => 'Actrice américaine, C.C. Babcock dans Une Nounou d\'Enfer.', 'imdb_id' => 'nm0486568', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Mercredi (IDs 26-28) ──────────────────────────────────────────
            ['name' => 'Jenna Ortega',       'birth_date' => '2002-09-27', 'biography' => 'Actrice américaine, Mercredi Addams dans la série Mercredi.', 'imdb_id' => 'nm3918035', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gwendoline Christie','birth_date' => '1978-10-28', 'biography' => 'Actrice britannique, connue pour GOT et le rôle de la directrice dans Mercredi.', 'imdb_id' => 'nm3302079', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Catherine Zeta-Jones','birth_date' => '1969-09-25', 'biography' => 'Actrice galloise, Morticia Addams dans Mercredi.', 'imdb_id' => 'nm0000214', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Suits (IDs 29-32) ─────────────────────────────────────────────
            ['name' => 'Gabriel Macht',      'birth_date' => '1972-01-22', 'biography' => 'Acteur américain, Harvey Specter dans Suits.', 'imdb_id' => 'nm0532683', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Patrick J. Adams',   'birth_date' => '1981-08-27', 'biography' => 'Acteur canadien, Mike Ross dans Suits.', 'imdb_id' => 'nm1512910', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Meghan Markle',      'birth_date' => '1981-08-04', 'biography' => 'Actrice américaine, Rachel Zane dans Suits. Devenue Duchesse de Sussex.', 'imdb_id' => 'nm1620783', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gina Torres',        'birth_date' => '1969-04-25', 'biography' => 'Actrice américaine, Jessica Pearson dans Suits.', 'imdb_id' => 'nm0868659', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Scandal (IDs 33-35) ───────────────────────────────────────────
            ['name' => 'Kerry Washington',   'birth_date' => '1977-01-31', 'biography' => 'Actrice américaine, Olivia Pope dans Scandal.', 'imdb_id' => 'nm0913488', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tony Goldwyn',       'birth_date' => '1960-05-20', 'biography' => 'Acteur américain, Président Fitzgerald Grant dans Scandal.', 'imdb_id' => 'nm0325014', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Darby Stanchfield',  'birth_date' => '1971-04-29', 'biography' => 'Actrice américaine, Abby Whelan dans Scandal.', 'imdb_id' => 'nm1019968', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Bones (IDs 36-38) ─────────────────────────────────────────────
            ['name' => 'Emily Deschanel',    'birth_date' => '1976-10-11', 'biography' => 'Actrice américaine, Dr. Temperance "Bones" Brennan dans Bones.', 'imdb_id' => 'nm0222002', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'David Boreanaz',     'birth_date' => '1969-05-16', 'biography' => 'Acteur américain, Seeley Booth dans Bones.', 'imdb_id' => 'nm0096527', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Michaela Conlin',    'birth_date' => '1978-06-28', 'biography' => 'Actrice américaine, Angela Montenegro dans Bones.', 'imdb_id' => 'nm1168239', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── The Vampire Diaries (IDs 39-42) ──────────────────────────────
            ['name' => 'Nina Dobrev',        'birth_date' => '1989-01-09', 'biography' => 'Actrice bulgaro-canadienne, Elena Gilbert dans The Vampire Diaries.', 'imdb_id' => 'nm2215143', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paul Wesley',        'birth_date' => '1982-07-23', 'biography' => 'Acteur américain, Stefan Salvatore dans The Vampire Diaries.', 'imdb_id' => 'nm1378844', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ian Somerhalder',    'birth_date' => '1978-12-08', 'biography' => 'Acteur américain, Damon Salvatore dans The Vampire Diaries.', 'imdb_id' => 'nm1377972', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Candice King',       'birth_date' => '1987-05-13', 'biography' => 'Actrice américaine, Caroline Forbes dans The Vampire Diaries.', 'imdb_id' => 'nm2941039', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],

            // ── Once Upon a Time (IDs 43-46) ─────────────────────────────────
            ['name' => 'Ginnifer Goodwin',   'birth_date' => '1978-05-22', 'biography' => 'Actrice américaine, Blanche-Neige/Mary Margaret dans Once Upon a Time.', 'imdb_id' => 'nm0330420', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jennifer Morrison',  'birth_date' => '1979-04-12', 'biography' => 'Actrice américaine, Emma Swan dans Once Upon a Time.', 'imdb_id' => 'nm0607865', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lana Parrilla',      'birth_date' => '1977-07-15', 'biography' => 'Actrice américaine, la Méchante Reine/Regina Mills dans Once Upon a Time.', 'imdb_id' => 'nm0663648', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Robert Carlyle',     'birth_date' => '1961-04-14', 'biography' => 'Acteur écossais, Rumplestiltskin/M. Gold dans Once Upon a Time.', 'imdb_id' => 'nm0001015', 'photo_url' => null, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('actors')->insert($actors);
    }
}
