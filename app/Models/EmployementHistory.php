<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployementHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'employement_title',
        'company_name',
        'user_id',
        'start_date',
        'end_date',
    ];
}
