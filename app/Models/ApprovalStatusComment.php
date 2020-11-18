<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalStatusComment extends Model
{
    protected $fillable = ['referer_id', 'added_by', 'type', 'status', 'description'];

    public function user() {
        return $this->belongsTo('App\User', 'added_by');
    }
}
