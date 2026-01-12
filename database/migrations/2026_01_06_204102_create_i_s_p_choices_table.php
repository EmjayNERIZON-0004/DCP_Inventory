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
        Schema::create('i_s_p_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->text('choice_text');
            $table->tinyInteger('choice_value');
            $table->boolean('is_other')->default(false);
            $table->timestamps();

            $table->foreign('question_id')
                ->references('id')
                ->on('i_s_p_questions')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_s_p_choices');
    }
};
