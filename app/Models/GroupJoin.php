<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupJoin extends Model
{
    protected $fillable = ['group_id', 'rider_id'];

    public function user() {
        return $this->belongsTo('App\User', 'rider_id'); 
    }
}
