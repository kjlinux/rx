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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('forenames');
            $table->enum('gender', ['M', 'F']);
            $table->unsignedTinyInteger('age');
            $table->tinyText('phone');
            $table->mediumText('clinical_information')->nullable();
            $table->foreignId('center_id')->constrained();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        // DB::statement("ALTER TABLE patients AUTO_INCREMENT = 2400;");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
