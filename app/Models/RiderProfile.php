<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiderProfile extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rider_profiles';

    protected $fillable = ['rider_id', 'total_km', 'image', 'riding_year', 'description', 'total_rides'];
}
