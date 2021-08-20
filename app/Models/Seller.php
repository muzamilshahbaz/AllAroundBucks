<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'seller_id';

    public function user()
    {
        return $this->belongsTo(User::class,'username');
    }
}
