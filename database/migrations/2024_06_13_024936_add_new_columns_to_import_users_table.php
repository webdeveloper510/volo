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
            $table->string('company_name')->nullable()->after('id');
            $table->string('entity_name')->nullable()->after('company_name');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_users', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('entity_name');
        });
    }
};
