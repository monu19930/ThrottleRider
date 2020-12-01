<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupFollow extends Model
{
    protected $fillable = ['group_id', 'followed_by'];
}
