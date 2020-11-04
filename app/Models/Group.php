<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

   protected $fillable = ['group_name', 'group_image', 'group_desc', 'create_rider_id'];


   public function user() {
        return $this->belongsTo('App\User', 'id');
   }

   public function groupJoinedRider() {
        return $this->hasMany('App\Models\GroupJoin');
   }
}
