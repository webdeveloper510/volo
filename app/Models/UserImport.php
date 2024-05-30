<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserImport extends Model
{
    use HasFactory;
    protected $table = 'import_users';
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'organization', 'status', 'category', 'location_geography', 'region', 'sales_subcategory', 'industry_sectors', 'measure_units_quantity', 'value_of_opportunity',
        'pain_points', 'timing_close', 'engagement_level', 'lead_status', 'difficult_level', 'deal_length', 'probability_to_close',
        'revenue_booked_to_date', 'referred_by', 'created_by', 'notes'
    ];



    public static $status = [
        'Active',
        'In Active'
    ];
    public static $convertedto = [
        'Yes',
        'no'
    ];
}
