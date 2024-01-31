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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->mediumInteger('amount_to_pay');
            $table->mediumInteger('payed')->nullable();
            $table->mediumInteger('left_to_pay')->nullable();
            $table->tinyInteger('discount')->nullable();
            $table->mediumInteger('amount_after_discount')->nullable();
            $table->uuid('slug');
            $table->foreignId('patient_id')->constrained();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
