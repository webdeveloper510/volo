<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    protected     $fillable = [
        'name',
        'created_by',
    ];
}
