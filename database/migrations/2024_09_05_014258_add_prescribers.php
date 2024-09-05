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
        DB::table('prescribers')->insert([
            'name' => 'Ettui',
            'forenames' => 'Joseph',
            'center_id' => 1,
            'speciality_id' => 2,
            'function_id' => 1
        ]);

        DB::table('prescribers')->insert([
            'name' => 'Yao',
            'forenames' => 'Casimir',
            'center_id' => 1,
            'speciality_id' => 2,
            'function_id' => 1
        ]);

        DB::table('prescribers')->insert([
            'name' => 'Kpata',
            'forenames' => 'Djoman',
            'center_id' => 1,
            'speciality_id' => 2,
            'function_id' => 1
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
