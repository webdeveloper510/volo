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
        Schema::create('paymentlogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('meetings');
            $table->float('amount');
            $table->string('name_of_card')->nullable();
            $table->string('response_code')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('auth_id')->nullable();
            $table->string('attachment')->nullable();
            $table->string('message_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymentlogs');
    }
};
