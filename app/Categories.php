<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';

    /**
     * categ constructor
     *
     */

    public $items;
    public $total;


    public function addCategoryAttribute($attribute)
    {

        /*
        if($categ!= NULL)
        {
            $this->items = $categ->items;
            $this->total= $categ->total;

        }
        else
        {
            $this->items =[];
            $this->total= 0;
        }
        */

        $this->items[$this->total] = $attribute;
        $this->total++;
    }
}
