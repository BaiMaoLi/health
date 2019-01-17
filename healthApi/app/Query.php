<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    protected $fillable = [
        'category_id','prefix','query', 'results_string', 'results_value'
    ];

}
