<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'product_name', 'category_id', 'product_desc', 'product_quantity', 'product_price',
    ];
    //protected $table = 'products';
}
