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
        Schema::table('leads', function (Blueprint $table) {   
            $table->string('primary_address')->after('primary_contact')->nullable();    
            $table->string('primary_organization')->after('primary_address')->nullable();            
            $table->string('secondary_name')->after('primary_organization')->nullable();
            $table->string('secondary_email')->after('secondary_name')->nullable();
            $table->string('secondary_address')->after('secondary_email')->nullable();
            $table->string('secondary_designation')->after('secondary_address')->nullable();       
            $table->string('category')->after('probability_to_close')->nullable();
            $table->string('sales_subcategory')->after('category')->nullable();
            $table->string('products')->after('sales_subcategory')->nullable();
            $table->text('hardware_one_time')->after('products')->nullable();
            $table->text('hardware_maintenance')->after('hardware_one_time')->nullable();
            $table->text('software_recurring')->after('hardware_maintenance')->nullable();
            $table->text('software_one_time')->after('software_recurring')->nullable();
            $table->text('systems_integrations')->after('software_one_time')->nullable();
            $table->text('subscriptions')->after('systems_integrations')->nullable();
            $table->text('tech_deployment_volume_based')->after('subscriptions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('primary_address');
            $table->dropColumn('primary_organization');            
            $table->dropColumn('secondary_name');
            $table->dropColumn('secondary_email');
            $table->dropColumn('secondary_address');
            $table->dropColumn('secondary_designation');       
            $table->dropColumn('category');
            $table->dropColumn('sales_subcategory');
            $table->dropColumn('products');
            $table->dropColumn('hardware_one_time');
            $table->dropColumn('hardware_maintenance');
            $table->dropColumn('software_recurring');
            $table->dropColumn('software_one_time');
            $table->dropColumn('systems_integrations');
            $table->dropColumn('subscriptions');
            $table->dropColumn('tech_deployment_volume_based');
        });
    }
};
