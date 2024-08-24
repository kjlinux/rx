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
        Prescriber::factory(300)->create();

        Prescriber::insert(
            [
                [
                    'id' => 1000,
                    'name' => 'Centre',
                    'forenames' => 'Externe',
                ]
            ]
        );
    }
}
