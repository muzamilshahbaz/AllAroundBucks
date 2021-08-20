<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'trainer_id';

    public function user()
    {
        return $this->belongsTo(User::class,'username');
    }

    public function course()
    {
        return $this->hasMany(Course::class, 'trainer_username');
    }
}
