<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

     protected $fillable = ['group_name', 'group_image', 'group_desc', 'city', 'create_rider_id', 'updated_by', 'ip_address'];


     public function user() {
          return $this->belongsTo('App\User', 'create_rider_id');
     }

     public function groupJoinedRider() {
          return $this->hasMany('App\Models\GroupJoin');
     }

     public function groupFollowedRider() {
          return $this->hasMany('App\Models\GroupFollow');
     }

     public function pastExperience() {
          return $this->hasMany('App\Models\GroupPastExperience');
     }

     public function approvalComments() {
          return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
      }

      public function events() {
          return $this->hasMany('App\Models\Event', 'group_id');
      }

      public function polls() {
          return $this->hasMany('App\Models\Poll', 'group_id');
      }
}
