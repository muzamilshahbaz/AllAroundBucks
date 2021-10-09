<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $primaryKey = 'user_id';

    public function seller()
    {
        return $this->hasOne(Seller::class, 'username');
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class, 'username');
    }
    public function trainer()
    {
        return $this->hasOne(Trainer::class, 'username');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'username');
    }

    // protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
