<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\ProductImages;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use App\Cart;
use App\Categories;
use App\Product_Images;
use App\Custom_Images;
use App\Discount;
use Illuminate\Support\Facades\Session;


class ProductsController extends Controller
{

   public function index(Request $request)
    {

        $products = Product::with(['products_images'=>
                function($query)
                {
                    $query->where('primary', '=', '1');
                }]
        )->get();


        $products_new = $products->where('is_new',1)->sortByDesc('created_at');

        $products_sale = $products->where('is_on_sale',1)->sortByDesc('sale_valid_date');


        $categories = Categories::orderBy('path')->get();
        $custom_images = Custom_Images::orderBy('primary')->get();
        $cart = Session::get('cart');



        return view('main',[
            'products'=> $products,
            'products_new'=>$products_new,
            'products_sale'=>$products_sale,
            'categories'=>$categories,
            'cart'=>$cart,
            'custom_images'=>$custom_images,
            ]);
    }

    public function showCart()
    {

        $products = Product::with(['products_images'=>
                function($query)
                {
                    $query->where('primary', '=', '1');
                }]
        )->get();

        $categories = Categories::orderBy('path')->get();

        $cart = Session::get('cart');
        //if ($cart) {
            //cart is not empty
            return view('cartproducts', ['cartItems' => $cart,'categories'=>$categories, 'cart'=>$cart]);
            //dump($cart);

        //} else {
            //cart is empty
            //return redirect()->route('main');
            // echo 'empty';
        //}
    }

    public function updateItemFromCart(Request $request)
    {

        $cart=$request->session()->get('cart');

        $rules = [];
        $customMessages = [];

        $counter=0;

        foreach($cart->items as $item)
        {
            $id = $request->input('product' . $counter);

            $quantity = 'quantity' . $counter; //name of field quantity1, quantity2...

            $products = Product::all();
            $product = $products->find($id);

            $max = $product->amount; //max amount on stock
            $max = 'max:' . $max;

            $rules += [$quantity=>['required','integer','min:1',$max]];
            $customMessages += [
                $quantity.'.max' => ' Maksymalna Ilość dostepna na magazynie to ' . $product->amount,
                'required' => 'Pole jest wymagane',
                'min' => '',
                'integer' => '',
            ];
            $counter++;
        }
        //dump($rules);
        $this->validate($request,$rules,$customMessages);

        $counter=0;
        foreach($cart->items as $item)
        {
            if(array_key_exists($id,$cart->items))
            {
                $new_quantity = $request->input($quantity);
                $cart->items[$id]['quantity']= $new_quantity;
                $cart->items[$id]['one_item_type_sum'] = $cart->items[$id]['quantity'] * $cart->items[$id]['price'];

            }
            $counter++;

        }

        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriseAndQuantity();

        $request->session()->put('cart',$updatedCart);
        return redirect()->route('cartproducts');
    }

    public function deleteItemFromCart(Request $request,$id)
    {

        $cart=$request->session()->get('cart');

            if(array_key_exists($id,$cart->items))
            {
                unset($cart->items[$id]);
            }

        $prevCart = $request->session()->get('cart');
        $updatedCart = new Cart($prevCart);
        $updatedCart->updatePriseAndQuantity();

        $request->session()->put('cart',$updatedCart);
        return redirect()->route('cartproducts');
    }

    public function single_product(Request $request,$id)
    {

        $categories = Categories::orderBy('path')->get();
        $cart = Session::get('cart');

        $products = Product::all();
        $product = $products->find($id);


        $products_images = Product_Images::all();
        $product_images = $products_images->where('product_id',$id);



        return view('singleproduct',['product'=>$product, 'product_images'=> $product_images, 'categories'=>$categories, 'cart'=>$cart]);
    }


}
