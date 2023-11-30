<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Prescribers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('prescribers')->insert([
            'name' => 'Koffi',
            'forenames' => 'Jude',
            'center_id' => 1,
            'function_id' => 1,
            'speciality_id' => 4
        ]);

        DB::table('prescribers')->insert([
            'name' => 'Assanvo',
            'forenames' => 'Horeb',
            'center_id' => 4,
            'function_id' => 1,
            'speciality_id' => 1
        ]);
    }
}
