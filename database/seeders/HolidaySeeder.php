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
            'date' => '01-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Lundi de Pâques",
            'date' => '04-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Fête du Travail",
            'date' => '05-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Ascension",
            'date' => '05-09',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Lundi de Pentecôte",
            'date' => '05-20',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "L'indépendance",
            'date' => '08-07',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Assomption de Marie",
            'date' => '08-15',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Toussaint",
            'date' => '11-01',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Journée nationale de la paix",
            'date' => '11-15',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Noël",
            'date' => '12-25',
            'activated' => 1
        ]);

        DB::table('holidays')->insert([
            'name' => "Holiday",
            'activated' => 0
        ]);

    }
}
