<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->integer('status')->default(0);
            $table->integer('direction')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('parent')->nullable();
            $table->integer('parent_id')->default(0);
            $table->integer('account')->default(0);
            $table->string('description')->nullable();
            $table->integer('attendees_user')->default(0);
            $table->integer('attendees_contact')->default(0);
            $table->integer('attendees_lead')->default(0);
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
        Schema::dropIfExists('calls');
    }
}
