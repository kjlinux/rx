<?php

namespace Database\Seeders;

use App\Models\Prescriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Prescriber::factory(5)->create();

        Prescriber::insert(
            [
                [
                    'name' => 'Traoré',
                    'forenames' => 'Djeneba',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Kouadio',
                    'forenames' => 'Alberic',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Buremoh',
                    'forenames' => 'Ismael',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Diallo',
                    'forenames' => 'Abdul',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Dembele',
                    'forenames' => 'Hamed',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Aholia',
                    'forenames' => 'Aka',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Kadji',
                    'forenames' => 'Paul Françoise',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Kouabenan',
                    'forenames' => 'Rosine',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Die',
                    'forenames' => 'Serge Alain',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Assoh',
                    'forenames' => 'Yoma Jean Luc',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Assa',
                    'forenames' => 'Tanoh',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Houphouet',
                    'forenames' => '',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Kramo',
                    'forenames' => 'Baudelaire',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Assoa',
                    'forenames' => 'Kouamé',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Bamba',
                    'forenames' => 'Matherin',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Diallo',
                    'forenames' => 'Abdul',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Kacou',
                    'forenames' => 'Yolande',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Sylla',
                    'forenames' => 'Fadina',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Amani',
                    'forenames' => 'Kouamé',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
                [
                    'name' => 'Yapi',
                    'forenames' => 'Bénédicte',
                    'center_id' => 1,
                    'speciality_id' => 1
                ],
            ]
        );

        Prescriber::insert([
            'id' => 1000,
            'name' => 'Centre',
            'forenames' => 'Externe',
            'center_id' => 2,
            'speciality_id' => 1
        ]);
    }
}
