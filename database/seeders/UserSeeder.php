<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Le Docteur',
            'email' => 'docteur@rx.rx',
            'password' => Hash::make('admin'),
        ]);

        User::create([
            'name' => 'Comptable',
            'email' => 'flora@rx.rx',
            'password' => Hash::make('azerty'),
        ]);
    }
}
