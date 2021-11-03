<?php

namespace App;


class Cart
{
    /**
     * cart constructor
     *
     */

    public $items; // ['id' => ['quantity','price']
    public $totalQuantity;
    public $totalPrice;

    public function __construct($prevCart)
    {
        if($prevCart != NULL)
        {
            $this->items = $prevCart->items;
            $this->totalQuantity= $prevCart->totalQuantity;
            $this->totalPrice= $prevCart->totalPrice;
        }
        else
        {
            $this->items =[];
            $this->totalQuantity= 0;
            $this->totalPrice=0;
        }
    }

    public function addItem($id,$product,$image,$quantity)
    {
        $price= (float) str_replace('$',"",$product->price);

        if($this->items != NULL && array_key_exists($id,$this->items))
        {
           $productToAdd = $this->items[$id];
           $productToAdd['quantity']+=$quantity;
           $productToAdd['one_item_type_sum'] = $productToAdd['quantity']*$price;
        }

        else
        {
            $productToAdd=[
                'quantity' => $quantity,
                'price'=>$price,
                'one_item_type_sum'=> $price*$quantity,
                'image'=>$image,
                'data'=>$product];
        }


        $this->items[$id] = $productToAdd;
        $this->totalQuantity+=$quantity;
        $this->totalPrice += $price*$quantity;

    }

    public function updatePriseAndQuantity()
    {
       $totalPrice =0; // local variable
       $totalQuantity=0;

       foreach($this->items as $item)
       {
           $totalQuantity+=$item['quantity'];
           $totalPrice+=$item['one_item_type_sum'];
       }

       $this->totalPrice= $totalPrice;
       $this->totalQuantity=$totalQuantity;

    }


}
