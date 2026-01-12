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
        Schema::table('i_s_p_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_id')->nullable()->after('id');
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
        Schema::table('isp_answers_model', function (Blueprint $table) {
            //
        });
    }
};
