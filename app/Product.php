<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product_Images;

class Product extends Model
{
    protected $table = 'products';

    public function getPriceAttribute($value) :string
    {
        return '$'.$value;
    }

    public function products_images()
    {
        return $this->hasMany(Product_Images::class,'product_id');
    }

}
