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
        Schema::create('school_equipment', function (Blueprint $table) {
            $table->id();

            $table->string('property_number')->unique();
            $table->string('old_property_number')->nullable();
            $table->string('serial_number')->nullable();

            $table->unsignedBigInteger('equipment_item_id')->nullable();
            $table->unsignedBigInteger('unit_of_measure_id')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->integer('dcp_batch_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('classification_id')->nullable();
            $table->unsignedBigInteger('mode_of_acquisition_id')->nullable();
            $table->unsignedBigInteger('source_of_acquisition_id')->nullable();
            $table->unsignedBigInteger('source_of_fund_id')->nullable();
            $table->unsignedBigInteger('allotment_class_id')->nullable();

            $table->string('model')->nullable();
            $table->text('specifications')->nullable();

            $table->boolean('non_dcp')->default(false);

            $table->string('gl_sl_code')->nullable();
            $table->string('uacs_code')->nullable();

            $table->decimal('acquisition_cost', 15, 2)->default(0);
            $table->date('acquisition_date')->nullable();

            $table->integer('estimated_useful_life')->nullable();

            $table->string('donor')->nullable();
            $table->string('pmp_reference_no')->nullable();
            $table->string('supplier_or_distributor')->nullable();

            $table->string('qr_code')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();

            /*
    |--------------------------------------------------------------------------
    | FOREIGN KEY CONSTRAINTS (EXPLICIT)
    |--------------------------------------------------------------------------
    */

            $table->foreign('equipment_item_id')
                ->references('id')->on('school_equipment_items')
                ->nullOnDelete();

            $table->foreign('unit_of_measure_id')
                ->references('id')->on('school_equipment_unit_of_measures')
                ->nullOnDelete();

            $table->foreign('manufacturer_id')
                ->references('id')->on('school_equipment_manufacturers')
                ->nullOnDelete();

            $table->foreign('dcp_batch_id')
                ->references('pk_dcp_batches_id')->on('dcp_batches')
                ->nullOnDelete();

            $table->foreign('category_id')
                ->references('id')->on('school_equipment_categories')
                ->nullOnDelete();

            $table->foreign('classification_id')
                ->references('id')->on('school_equipment_classifications')
                ->nullOnDelete();

            $table->foreign('mode_of_acquisition_id')
                ->references('id')->on('school_equipment_mode_of_acquisitions')
                ->nullOnDelete();

            $table->foreign('source_of_acquisition_id')
                ->references('id')->on('school_equipment_source_of_acquisitions')
                ->nullOnDelete();

            $table->foreign('source_of_fund_id')
                ->references('id')->on('school_equipment_source_of_funds')
                ->nullOnDelete();

            $table->foreign('allotment_class_id')
                ->references('id')->on('school_equipment_allotment_classes')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_equipment');
    }
};
