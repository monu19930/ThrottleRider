<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['start_location', 'end_location', 'via_location', 'start_date', 'end_date', 'no_of_people', 'short_description', 'group_id', 'rider_id', 'ride_days', 'luggage', 'updated_by', 'ip_address'];

    public function group() {
        return $this->belongsTo('App\Models\Group', 'group_id');
   }

   public function approvalComments() {
    return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
}
}
