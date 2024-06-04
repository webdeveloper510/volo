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
        Schema::create('nda', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->string('aggrement_day')->nullable();
            $table->string('aggrement_by')->nullable();
            $table->string('aggrement_receiving_party')->nullable();
            $table->string('aggrement_transaction')->nullable();
            $table->string('disclosing_by')->nullable();
            $table->string('disclosing_name')->nullable();
            $table->string('disclosing_title')->nullable();
            $table->string('receiving_by')->nullable();
            $table->string('receiving_name')->nullable();
            $table->string('receiving_title')->nullable();
            $table->string('image')->nullable();
            $table->string('nda_response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nda');
    }
};
