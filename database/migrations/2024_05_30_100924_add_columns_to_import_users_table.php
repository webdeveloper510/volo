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
        Schema::table('import_users', function (Blueprint $table) {
            $table->string('location_geography')->nullable()->after('category');
            $table->string('region')->nullable()->after('location_geography');
            $table->string('sales_subcategory')->nullable()->after('region');
            $table->string('industry_sectors')->nullable()->after('sales_subcategory');
            $table->string('measure_units_quantity')->nullable()->after('industry_sectors');
            $table->string('value_of_opportunity')->nullable()->after('measure_units_quantity');
            $table->string('pain_points')->nullable()->after('value_of_opportunity');
            $table->string('timing_close')->nullable()->after('pain_points');
            $table->string('engagement_level')->nullable()->after('timing_close');
            $table->string('lead_status')->nullable()->after('engagement_level');
            $table->string('difficult_level')->nullable()->after('lead_status');
            $table->string('deal_length')->nullable()->after('difficult_level');
            $table->string('probability_to_close')->nullable()->after('deal_length');
            $table->string('revenue_booked_to_date')->nullable()->after('probability_to_close');
            $table->string('referred_by')->nullable()->after('revenue_booked_to_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_users', function (Blueprint $table) {
            $table->dropColumn([
                'location_geography',
                'region',
                'sales_subcategory',
                'industry_sectors',
                'measure_units_quantity',
                'value_of_opportunity',
                'pain_points',
                'timing_close',
                'engagement_level',
                'lead_status',
                'difficult_level',
                'deal_length',
                'probability_to_close',
                'revenue_booked_to_date',
                'referred_by',
            ]);
        });
    }
};
