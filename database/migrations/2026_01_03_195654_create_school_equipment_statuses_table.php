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
        Schema::create('school_equipment_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_equipment_id');
            $table->date('start_warranty_date')->nullable();
            $table->date('end_warranty_date')->nullable();
            $table->unsignedBigInteger('equipment_condition_id')->nullable();
            $table->unsignedBigInteger('disposition_status_id')->nullable();
            $table->text('equipment_location')->nullable();
            $table->boolean('non_functional');
            $table->timestamps();

            $table->foreign('school_equipment_id')->references('id')->on('school_equipment')->onDelete('cascade');
            $table->foreign('equipment_condition_id')->references('id')->on('school_equipment_conditions')->onDelete('set null');
            $table->foreign('disposition_status_id')->references('id')->on('school_equipment_dispositions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_equipment_statuses');
    }
};
