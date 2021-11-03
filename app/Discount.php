<?php

namespace App;
use App\Products;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{

    protected $table = 'discounts';

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}