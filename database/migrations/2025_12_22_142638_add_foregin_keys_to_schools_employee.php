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
        Schema::table('schools_employee', function (Blueprint $table) {
            $table->foreign('ro_office_id')
                ->references('id')
                ->on('emp_ro_office')
                ->onDelete('set null');

            // SDO Office foreign key
            $table->foreign('sdo_office_id')
                ->references('id')
                ->on('emp_sdo_office')
                ->onDelete('set null');

            // Position foreign key
            $table->foreign('position_id')
                ->references('id')
                ->on('emp_position')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools_employee', function (Blueprint $table) {
            $table->dropForeign(['ro_office_id']);
            $table->dropForeign(['sdo_office_id']);
            $table->dropForeign(['position_id']);
        });
    }
};
