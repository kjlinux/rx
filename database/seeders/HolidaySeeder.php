<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('holidays')->insert([
            'name' => "Nouvel An",
            'primary_date' => '01-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Lundi de Pâques",
            'primary_date' => '04-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Fête du Travail",
            'primary_date' => '05-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Ascension",
            'primary_date' => '05-09',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Lundi de Pentecôte",
            'primary_date' => '05-20',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "L'indépendance",
            'primary_date' => '08-07',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Assomption de Marie",
            'primary_date' => '08-15',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Toussaint",
            'primary_date' => '11-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Journée nationale de la paix",
            'primary_date' => '11-15',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Noël",
            'primary_date' => '12-25',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Nuit du Destin",
            'primary_date' => '04-05',
            'secondary_date' => '04-06',
            'activated' => 0
        ]);

        DB::table('holidays')->insert([
            'name' => "Ramadan",
            'primary_date' => '04-09',
            'secondary_date' => '04-10',
            'activated' => 0
        ]);

        DB::table('holidays')->insert([
            'name' => "Tabaski",
            'primary_date' => '06-16',
            'secondary_date' => '06-17',
            'activated' => 0
        ]);

        DB::table('holidays')->insert([
            'name' => "Mawlid",
            'primary_date' => '09-15',
            'secondary_date' => '09-16',
            'activated' => 0
        ]);
    }
}
