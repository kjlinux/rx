<?php

namespace Database\Seeders;

use App\Models\Send;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Send::factory(50)->create();
    }
}
