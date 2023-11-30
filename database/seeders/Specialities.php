<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Specialities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $specialities = [
            'Généraliste', 'Gynécologue', 'ORL', 'Pédiatre'
        ];

        foreach ($specialities as $data) {
            DB::table('specialities')->insert([
                'name' => $data,
            ]);
        }
    }
}
