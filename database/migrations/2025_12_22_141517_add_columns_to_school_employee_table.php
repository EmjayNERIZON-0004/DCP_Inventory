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
            $table->string('suffix_name')->nullable()->after('l4nt_recipient');
            $table->unsignedBigInteger('ro_office_id')->nullable()->after('suffix_name');
            $table->unsignedBigInteger('sdo_office_id')->nullable()->after('ro_office_id');
            $table->unsignedBigInteger('position_id')->nullable()->after('sdo_office_id');
            $table->boolean('officer_in_charge')->default(0)->after('position_id');
            $table->string('mobile_no_1')->nullable()->after('officer_in_charge');
            $table->string('mobile_no_2')->nullable()->after('mobile_no_1');
            $table->string('personal_email_address')->nullable()->after('mobile_no_2');
            $table->date('date_hired')->nullable()->after('personal_email_address');
            $table->boolean('inactive')->default(0)->after('date_hired');
            $table->date('date_of_separation')->nullable()->after('inactive');
            $table->unsignedBigInteger('cause_of_separation')->nullable()->after('date_of_separation');
            $table->boolean('non_deped_fund')->nullable()->default(0)->after('cause_of_separation');
            $table->unsignedBigInteger('sources_of_fund_id')->nullable()->after('non_deped_fund');
            $table->string('detailed_transfer_from')->nullable()->after('sources_of_fund_id');
            $table->string('detailed_transfer_to')->nullable()->after('detailed_transfer_from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('schools_employee', function (Blueprint $table) {
            // $table->dropForeign(['ro_office_id']);
            // $table->dropForeign(['sdo_office_id']);
            // $table->dropForeign(['position_id']);
            $table->dropColumn([
                'suffix_name',
                'ro_office_id',
                'sdo_office_id',
                'position_id',
                'officer_in_charge',
                'mobile_no_1',
                'mobile_no_2',
                'personal_email_address',
                'date_hired',
                'inactive',
                'date_of_separation',
                'cause_of_separation',
                'non_deped_fund',
                'sources_of_fund_id',
                'detailed_transfer_from',
                'detailed_transfer_to',
            ]);
        });
    }
};
