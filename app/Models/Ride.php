<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    //
    protected $fillable = ['start_location', 'end_location', 'via_location', 'slug', 'start_date', 'end_date', 'no_of_people', 'short_description', 'rider_id', 'ride_days', 'luggage', 'updated_by', 'ip_address'];

    public function user() {
        return $this->belongsTo('App\User', 'rider_id');
    }

    public function approvalComments() {
        return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
    }

    public function rideDays() {
        return $this->hasMany('App\Models\RideDay', 'ride_id');
    }
}
