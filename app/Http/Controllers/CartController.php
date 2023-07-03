<?php

namespace App\Http\Controllers;

use App\Product_Images;
use Illuminate\Http\Request;

use App\Product;
use App\Cart;
use App\Categories;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function store(Request $request,$id)
    {

        // todo refactor

        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $products = Product::all();
        $product =$products->find($id);
        $image = Product_Images::where('product_id',$id)->where('primary',1)->pluck('image');


        $cart->addItem($id,$product,$image[0],1);
        $request->session()->put('cart', $cart);


        return redirect()->route('main');

    }

    public function addProductToCartStore(Request $request)
    {
        $prevCart = $request->session()->get('cart');
        $cart = new Cart($prevCart);

        $id = $request->input('id');

        $products = Product::all();
        $product =$products->find($id);


        if($product) {
            $max = 'max:'.$product->amount;
            $rules = ['quantity' => ['required', 'integer', 'min:1', $max],
                'id' => ['required', 'integer']];
            $customMessages = [];

            $quantity = $request->input('quantity');

            $this->validate($request, $rules, $customMessages);

            $image = Product_Images::where('product_id', $id)->where('primary', 1)->pluck('image');
            $cart->addItem($id, $product, $image[0], $quantity);

            $request->session()->put('cart', $cart);
            //dump($cart);

        }

        return redirect()->route('main');

    }


}
