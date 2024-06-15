<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserImport extends Model
{
    use HasFactory;

    protected $table = 'import_users';

    protected $fillable = [
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
        'location',
        'region',
        'industry',
        'engagement_level',
        'revenue_booked_to_date',
        'referred_by',
        'pain_points',
        'notes',
        'status',
        'company_name',
        'entity_name'
    ];

    public static $status = [
        'Active',
        'In Active'
    ];

    public static $convertedto = [
        'Yes',
        'no'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
}
