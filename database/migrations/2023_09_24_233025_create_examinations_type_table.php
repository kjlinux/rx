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
        Schema::create('examinations_type', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->tinyText('code');
            $table->unsignedTinyInteger('z_coefficient');
            $table->foreignId('examination_group_id')->constrained(
                table: 'examinations_group'
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
        Schema::dropIfExists('examinations_type');
    }
};
