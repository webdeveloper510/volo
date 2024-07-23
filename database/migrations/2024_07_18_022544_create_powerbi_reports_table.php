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
            $table->string('PBI_group_id');
            $table->string('PBI_report_id');
            $table->string('PBI_dataset_id');
            $table->string('PBI_embed_url');
            $table->string('report_name');
            $table->boolean('is_rls_enabled')->default(0);
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
