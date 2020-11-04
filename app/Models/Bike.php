<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    //
    protected $fillable = ['name', 'image', 'total_km', 'total_rides', 'info', 'comfortness', 'reliability', 'visual_appeal', 'performance', 'service_experience', 'rider_id'];
}
