<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'event_title',
        'event_date',
        'event_time',
        'featured_picture',
        'event_body',
        'event_location',
        'category_name',
        'tag_name',

    ];
}
