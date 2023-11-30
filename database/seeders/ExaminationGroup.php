<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExaminationGroup extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $examination_group = [
            'crâne', 'cage thoracique', 'colonne vertébrale',
            'membres supérieurs', 'membres inférieurs', 'tube digestif',
            'appareil urinaire', 'gynécologie', 'divers'
        ];

        foreach($examination_group as $data){
            DB::table('examinations_group')->insert([
                'name' => $data,
                'code' => getInitial($data)
            ]);
        }

    }
}
