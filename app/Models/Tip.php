<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = ['tip_title', 'file_name', 'tip_description', 'rider_id', 'updated_by', 'ip_address'];

    public function user() {
        return $this->belongsTo('App\User', 'rider_id');
    }

    public function approvalComments() {
        return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
    }
}
