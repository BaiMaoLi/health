<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $fillable = [
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone',
        'birthday',
        'gender',
        'wellness_coash_id',
        'profile_picture'

    ];
}
