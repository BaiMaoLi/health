<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class event_user extends Model
{
    protected $fillable = [
        'event_id',
        'user_id',
    ];
}
