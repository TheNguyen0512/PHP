<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product'; 
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_id','product_name', 'brand', 'description', 'price', 'product_category_id', 'image_url'
    ];
}
