<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'category', 'description'
    ];
    //protected $table = 'categories';
}