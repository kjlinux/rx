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
            'name' => 'Thorax osseux ou Gril Costal F/P',
            'code' => 'TOGCF_FP',
            'z_coefficient' => 15,
            'examination_group_id' => 2,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('examinations_type')
            ->where('code', 'TOGCF_FP')
            ->delete();
    }
};
