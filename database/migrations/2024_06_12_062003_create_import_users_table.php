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
        Schema::create('import_users', function (Blueprint $table) {
            $table->id();
            $table->string('primary_name');
            $table->string('primary_phone_number');
            $table->string('primary_email');
            $table->string('primary_address');
            $table->string('primary_organization');
            $table->string('secondary_name')->nullable();
            $table->string('secondary_phone_number')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('secondary_address')->nullable();
            $table->string('secondary_designation')->nullable();
            $table->string('location')->nullable();
            $table->string('region')->nullable();
            $table->string('industry')->nullable();
            $table->string('engagement_level')->nullable();
            $table->string('revenue_booked_to_date')->nullable();
            $table->string('referred_by')->nullable();
            $table->text('pain_points')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default(0);
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_users');
    }
};
