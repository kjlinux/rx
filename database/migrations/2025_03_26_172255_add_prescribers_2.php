<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('prescribers')->insert([
            [
                'name' => 'ABOLE',
                'forenames' => 'Andréa',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'SESS',
                'forenames' => 'Jérôme',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'KADJA',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'DJAHA',
                'forenames' => 'Roxane',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'GOUANOU',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'YAPI',
                'forenames' => 'Bénédicte Flora',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'KOUASSI',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'BONIE',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'ADJOUSSOU',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'YAO',
                'forenames' => 'Casimir',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ],
            [
                'name' => 'KRAMO',
                'forenames' => '',
                'center_id' => 1,
                'speciality_id' => 1,
                'function_id' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('prescribers')
            ->whereIn('name', [
                'ABOLE',
                'SESS',
                'KADJA',
                'DJAHA',
                'GOUANOU',
                'YAPI',
                'KOUASSI',
                'BONIE',
                'ADJOUSSOU',
                'YAO',
                'KRAMO'
            ])
            ->delete();
    }
};
