<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideDay extends Model
{
    protected $fillable = ['ride_id', 'start_location','end_location', 'number_of_day', 'start_date', 'total_km', 'ride_rating', 'is_petrol_pump', 'petrol_pump_comment', 'is_restaurant',
                    'is_restaurant_comment', 'is_hotel', 'hotel_name', 'is_parking', 'is_wifi', 'road_type', 'road_quality', 'road_scenic', 'day_description', 'ride_images'];



    public function ride(){
        return $this->belongsTo('App\Models\Ride', 'ride_id');
    }
    

    public function roadType(){
        return $this->belongsTo('App\Models\RoadType', 'road_type');
    }
}
