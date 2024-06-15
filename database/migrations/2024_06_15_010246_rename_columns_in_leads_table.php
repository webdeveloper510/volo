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
        Schema::table('leads', function (Blueprint $table) {
            $table->renameColumn('leadname', 'opportunity_name');
            $table->renameColumn('name', 'primary_name');
            $table->renameColumn('email', 'primary_email');
            $table->renameColumn('function', 'value_of_opportunity');
            $table->renameColumn('rooms', 'currency');
            $table->renameColumn('bar', 'timing_close');
            $table->renameColumn('venue_selection', 'sales_stage');
            $table->renameColumn('spcl_req', 'deal_length');
            $table->renameColumn('allergies', 'difficult_level');
            $table->renameColumn('ad_opts', 'probability_to_close');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->renameColumn('opportunity_name', 'leadname');
            $table->renameColumn('primary_name', 'name');
            $table->renameColumn('primary_email', 'email');
            $table->renameColumn('value_of_opportunity', 'function');
            $table->renameColumn('currency', 'rooms');
            $table->renameColumn('timing_close', 'bar');
            $table->renameColumn('sales_stage', 'venue_selection');
            $table->renameColumn('deal_length', 'spcl_req');
            $table->renameColumn('difficult_level', 'allergies');
            $table->renameColumn('probability_to_close', 'ad_opts');
        });
    }
};
