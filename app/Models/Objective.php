<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'category',
        'objective',
        'measure',
        'key_dates',
        'status',
        'q1_updates',
        'q2_updates',
        'q3_updates',
        'q4_updates',
        'eoy_review'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
