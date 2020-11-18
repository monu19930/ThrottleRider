<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    //
    protected $fillable = ['name', 'image', 'total_km', 'total_rides', 'info', 'comfortness', 'reliability', 'visual_appeal', 'performance', 'service_experience', 'rider_id', 'updated_by', 'ip_address'];

    public function user() {
        return $this->belongsTo('App\User', 'rider_id');
   }

    public function approvalComments() {
        return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
    }
}
