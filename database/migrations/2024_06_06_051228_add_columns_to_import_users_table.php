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
            $table->string('hardware_one_time')->nullable()->after('product_category');
            $table->string('hardware_maintenance')->nullable()->after('hardware_one_time');
            $table->string('software_recurring')->nullable()->after('hardware_maintenance');
            $table->string('software_one_time')->nullable()->after('software_recurring');
            $table->string('systems_integrations')->nullable()->after('software_one_time');
            $table->string('subscriptions')->nullable()->after('systems_integrations');
            $table->string('tech_deployment')->nullable()->after('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('import_users', function (Blueprint $table) {
            $table->dropColumn([
                'hardware_one_time',
                'hardware_maintenance',
                'software_recurring',
                'software_one_time',
                'systems_integrations',
                'subscriptions',
                'tech_deployment'
            ]);
        });
    }
};
