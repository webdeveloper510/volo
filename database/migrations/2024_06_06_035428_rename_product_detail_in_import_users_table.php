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
            $table->renameColumn('product_detail', 'product_category');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_users', function (Blueprint $table) {
            $table->renameColumn('product_category', 'product_detail');
        });
    }
};
