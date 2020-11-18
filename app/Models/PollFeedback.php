<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollFeedback extends Model
{
    protected $fillable = ['rider_id', 'answer'];
    protected $table = 'poll_feedbacks';
}
