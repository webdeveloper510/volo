<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('name')->nullable();
            $table->integer('account')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->default(0);
            $table->text('contact_address')->nullable();
            $table->string('contact_city')->nullable();
            $table->string('contact_state')->nullable();
            $table->string('contact_country')->nullable();
            $table->string('contact_postalcode')->nullable();
            $table->string('description')->nullable();
            $table->integer('is_active')->default(1);
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
