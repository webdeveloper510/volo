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
        Schema::create('powerbi_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->uuid('group_id');
            $table->uuid('report_id');
            $table->uuid('dataset_id');
            $table->string('embed_url');
            $table->boolean('is_rls_enabled');
            $table->boolean('permission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('powerbi_reports');
    }
};
