<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    //
    protected $table = "plays";
    protected $fillable = [
        "title",
        "argument",
        "author",
        "duration",
        "room_id",
        "company_id"
    ];
}
