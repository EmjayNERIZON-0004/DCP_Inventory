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
        Schema::create('i_s_p_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');
            $table->enum('question_type', ['boolean', 'single', 'multiple', 'text', 'number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_s_p_questions');
    }
};
