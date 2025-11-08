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
        Schema::table('dcp_batch_items', function (Blueprint $table) {
            $table->integer('monitored')->default(0)->after('date_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dcp_batch_items', function (Blueprint $table) {
            // Drop the column when rolling back
            $table->dropColumn('monitored');
        });
    }
};
