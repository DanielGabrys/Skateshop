<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Images extends Model
{
    protected $table = 'products_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
