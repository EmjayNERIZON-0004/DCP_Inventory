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
        Schema::create('i_s_p_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->nullable();
            $table->unsignedBigInteger('choice_id')->nullable();
            $table->text('text_value')->nullable();
            $table->decimal('numeric_value')->nullable();
            $table->text('other_value')->nullable();
            $table->timestamps();

            $table->foreign('school_id')
                ->references('pk_school_id')
                ->on('schools')
                ->onDelete('set null');
            $table->foreign('choice_id')
                ->references('id')
                ->on('i_s_p_choices')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_s_p_answers');
    }
};
