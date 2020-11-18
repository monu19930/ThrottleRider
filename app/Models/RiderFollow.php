<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderFollow extends Model
{
    protected $fillable = ['rider_id', 'followed_by'];
}
