<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomOpportunity extends Model
{
    use HasFactory;
    protected $table = 'custom_opportunities';
    protected $fillable = [
        'user_id',
        'opportunity_name',
        'existing_client',
        'client_name',
        'primary_name',
        'primary_phone_number',
        'primary_email',
        'primary_address',
        'primary_organization',
        'secondary_name',
        'secondary_phone_number',
        'secondary_email',
        'secondary_address',
        'secondary_designation',
        'assigned_user',
        'value_of_opportunity',
        'currency',
        'timing_close',
        'sales_stage',
        'deal_length',
        'difficult_level',
        'probability_to_close',
        'category',
        'sales_subcategory',
        'products',
        'hardware_one_time',
        'hardware_maintenance',
        'software_recurring',
        'software_one_time',
        'systems_integrations',
        'subscriptions',
        'tech_deployment_volume_based',
        'status',
        'created_by',
        'is_nda_signed',
        'is_deleted',
    ];
}
