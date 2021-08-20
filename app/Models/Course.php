<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'course_id';

    public function trainer()
    {
        return $this->belongsTo(Trainer::class,'trainer_username');
    }

    public function courseVideo()
    {
        return $this->hasMany(CourseVideo::class, 'course_id');
    }

}
