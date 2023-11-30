<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CenterCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $center_categories = [
            'Clinique médicale', 'Centre Hospitalier et Universitaire', 'Formation Sanitaire Urbaine', 
            'Infirmerie', 'Hôpital Général', 'Centre de Santé Urbain'
        ];

        foreach ($center_categories as $data) {
            DB::table('center_categories')->insert([
                'name' => $data,
            ]);
        }
    }
}
