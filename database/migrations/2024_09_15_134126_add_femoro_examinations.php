<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('examinations_type')->insert([
            'name' => 'Défilé femoro patellaire 30°',
            'code' => 'DFPA3',
            'z_coefficient' => 6,
            'examination_group_id' => 5,
        ]);

        DB::table('examinations_type')->insert([
            'name' => 'Défilé femoro patellaire 60°',
            'code' => 'DFPA6',
            'z_coefficient' => 6,
            'examination_group_id' => 5,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
