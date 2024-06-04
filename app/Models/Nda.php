<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nda extends Model
{
    use HasFactory;
    protected $table = 'nda';
    protected $fillable = [
        'user_id',
        'lead_id',
        'aggrement_day',
        'aggrement_by',
        'aggrement_receiving_party',
        'aggrement_transaction',
        'disclosing_by',
        'disclosing_name',
        'disclosing_title',
        'receiving_by',
        'receiving_name',
        'receiving_title',
        'image',
        'nda_response',
    ];
}
