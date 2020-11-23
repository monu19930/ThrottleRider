<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['poll_name', 'options', 'rider_id', 'group_id', 'updated_by', 'ip_address', 'created_at'];

    public function user() {
        return $this->belongsTo('App\User', 'rider_id');
    }

    public function approvalComments() {
        return $this->hasMany('App\Models\ApprovalStatusComment', 'referer_id');
    }
}
