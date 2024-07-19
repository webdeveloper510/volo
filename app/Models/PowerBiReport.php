<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PowerBiReport extends Model
{
    use HasFactory;
    protected $table = 'powerbi_reports';
    protected $fillable = [
        'name',
        'group_id',
        'report_id',
        'dataset_id',
        'embed_url',
        'is_rls_enabled',
        'permission',
    ];
}
