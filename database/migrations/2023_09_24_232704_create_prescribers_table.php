<?php

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
        Schema::create('prescribers', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('forenames');
            $table->foreignId('center_id')->nullable()->constrained();
            $table->foreignId('function_id')->nullable()->constrained();
            $table->foreignId('speciality_id')->nullable()->constrained(
                table: 'specialities'
            );
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescribers');
    }
};
