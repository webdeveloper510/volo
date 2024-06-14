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
        Schema::create('custom_opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('opportunity_name')->nullable();
            $table->string('existing_client')->nullable();
            $table->string('client_name')->nullable();
            $table->string('primary_name')->nullable();
            $table->string('primary_phone_number')->nullable();
            $table->string('primary_email')->nullable();
            $table->string('primary_address')->nullable();
            $table->string('primary_organization')->nullable();
            $table->string('secondary_name')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('secondary_designation')->nullable();
            $table->integer('assigned_user');
            $table->string('value_of_opportunity')->nullable();
            $table->string('currency')->nullable();
            $table->string('timing_close')->nullable();
            $table->string('sales_stage')->nullable();
            $table->string('deal_length')->nullable();
            $table->string('difficult_level')->nullable();
            $table->string('probability_to_close')->nullable();
            $table->string('category')->nullable();
            $table->string('sales_subcategory')->nullable();
            $table->string('products')->nullable();
            $table->string('hardware_one_time')->nullable();
            $table->string('hardware_maintenance')->nullable();
            $table->string('software_recurring')->nullable();
            $table->string('software_one_time')->nullable();
            $table->string('systems_integrations')->nullable();
            $table->string('subscriptions')->nullable();
            $table->string('tech_deployment_volume_based')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('is_nda_signed')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_opportunities');
    }
};
