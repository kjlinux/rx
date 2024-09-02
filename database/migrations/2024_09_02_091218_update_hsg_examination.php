<?php

use App\Models\ExaminationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $hsg = ExaminationType::where('code', 'like', '%HSG%')->first();
        
        if ($hsg) {
            $hsg->forceFill(['z_coefficient' => 45])->save();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
