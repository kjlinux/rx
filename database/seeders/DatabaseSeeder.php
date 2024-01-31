<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Examination;
use App\Models\Prescriber;
use App\Models\Send;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            ExaminationGroup::class,
            ExaminationType::class,
            Functions::class,
            Specialities::class,
            CenterCategory::class,
            Center::class,
            HolidaySeeder::class,
            UserSeeder::class,
            RoleSeeder::class,
            PrescriberSeeder::class,
            PatientSeeder::class,
            VoucherSeeder::class,
            ExaminationSeeder::class,
            SendSeeder::class,
        ]);
    }
}
