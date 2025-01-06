<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'play_title',
        'play_id',
        'room_id',
    ];
}
