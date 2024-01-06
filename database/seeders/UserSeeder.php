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
            'name' => 'Ghost',
            'email' => 'admin@rx.ghost',
            'password' => Hash::make('DIDIERbleou1995'),
        ]);

        User::create([
            'name' => 'Caissière',
            'email' => 'accountant@rx.ghost',
            'password' => Hash::make('DIDIERbleou1995'),
        ]);
    }
}
