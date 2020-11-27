<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPastExperience extends Model
{
    protected $fillable = ['title', 'added_on', 'description', 'images', 'group_id', 'rider_id'];
}
