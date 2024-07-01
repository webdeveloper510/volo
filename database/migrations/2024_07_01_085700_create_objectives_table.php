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
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('year')->nullable();
            $table->string('category')->nullable();
            $table->text('objective')->nullable();
            $table->text('measure')->nullable();
            $table->string('key_dates')->nullable();
            $table->string('status')->nullable();
            $table->text('q1_updates')->nullable();
            $table->text('q2_updates')->nullable();
            $table->text('q3_updates')->nullable();
            $table->text('q4_updates')->nullable();
            $table->text('eoy_review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectives');
    }
};
