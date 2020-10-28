<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    //
    protected $fillable = ['name', 'image', 'rider_id', 'total_km', 'info'];
}
