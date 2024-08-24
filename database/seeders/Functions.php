<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Functions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $functions = [
            'Médecin',
            'Infirmier',
            'Professeur',
            'Autre'
        ];

        foreach ($functions as $data) {
            DB::table('functions')->insert([
                'name' => $data,
            ]);
        }
    }
}
