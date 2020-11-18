<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier_name', 'supplier_image', 'supplier_rating', 'supplier_address', 'supplier_description', 'spare_parts', 'rider_id', 'updated_by', 'ip_address'];


     public function user() {
          return $this->belongsTo('App\User', 'rider_id');
     }

     public function approvalComments() {
          return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
     }
}
