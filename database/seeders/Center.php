<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Center extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('centers')->insert([
            'name' => 'Communautaire Angré',
            'center_category_id' => 6
        ]);

        DB::table('centers')->insert([
            'name' => 'Chrysalide',
            'center_category_id' => 1
        ]);

        DB::table('centers')->insert([
            'name' => 'Angré',
            'center_category_id' => 2
        ]);

        DB::table('centers')->insert([
            'name' => 'Cocody',
            'center_category_id' => 2
        ]);

        DB::table('centers')->insert([
            'name' => 'Treichville',
            'center_category_id' => 2
        ]);

        DB::table('centers')->insert([
            'name' => 'Yopougon',
            'center_category_id' => 2
        ]);

        DB::table('centers')->insert([
            'name' => 'Toit Rouge',
            'center_category_id' => 3
        ]);

        DB::table('centers')->insert([
            'name' => 'Gendarmerie',
            'center_category_id' => 4
        ]);

        DB::table('centers')->insert([
            'name' => 'Grand Centre',
            'center_category_id' => 1
        ]);

        DB::table('centers')->insert([
            'name' => 'Yopougon Attié',
            'center_category_id' => 5
        ]);

        DB::table('centers')->insert([
            'name' => 'Iroko',
            'center_category_id' => 1
        ]);

        DB::table('centers')->insert([
            'name' => 'Externe',
            'center_category_id' => 7
        ]);
    }
}
