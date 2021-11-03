<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom_Images extends Model
{
    public $timestamps = true;
    protected $table = 'custom_images';
    protected $fillable = ['created_at','updated_at'];
}
