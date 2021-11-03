<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Product_Images;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;


class AdminProductsController extends Controller
{
    public $no_image='no image.png';
    public $max_images_amount=5;

    public function index()
    {

        $products = Product::with(['products_images'=>
            function($query)
            {
                $query->where('primary', '=', '1');
            }]
        )->get();

        //new products
        
        
   
        //dump($products);
        return view('admin.displayProducts',['products'=>$products]);
        //return $products;

    }


    public function editProductsForm($id)
    {
        $products = Product::all();
        $product =$products->find($id);

        $products_images = Product_Images::all();
        $product_images = $products_images->where('product_id',$id);

        return view('admin.editProduct',[
            'product'=>$product,
            'product_images'=>$product_images,
            'max_images_amount'=>$this->max_images_amount]);

    }


    public function overviewProduct($id)
    {
        $products = Product::all();
        $product =$products->find($id);

        $products_images = Product_Images::all();
        $product_images = $products_images->where('product_id',$id);

        return view('admin.overviewProduct',[
            'product'=>$product,
            'product_images'=>$product_images,
            'max_images_amount'=>$this->max_images_amount]);

    }

    public function updateProducts(Request $request, $id)
    {

        $insertArrayImages=[];  //list of images to update
        $updateArrayImages=[]; //we update only primary image (first) and it hasnt default image

        $products = Product::all();
        $product =$products->find($id);

        $products_images = Product_Images::all();
        $count = $products_images->where('product_id',$id)->count();
        $count2 = $products_images->where('product_id',$id)->where('image',$this->no_image)->count();

        if($count2==1){$count--;} //if there is only one image and is default timage (no image.jpg)

       $this->validate_product($request,$count); //we changing validation rules

       $name = $request->input('name');
       $description = $request->input('description');
       $price = $request->input('price');
       $amount = $request->input('amount');

        for($i=0;$i<$this->max_images_amount;$i++) // iteration by image fields
        {
            $prim=$i+1;

            if ($request->hasFile('new_image'.$i)) //if there is image loaded in field
            {

                //if image name representing name of product exist in storage it means we have image name in database we only change image in storage leaving the same name
                $exist = Storage::disk('local')->exists('public/product_images/'.$product->name.$i);

                // if image exist and has set name
                if($exist)
                {
                        if($i==0) {$prim=1;} //if we are changing firsst image(primary image)
                        Storage::delete('public/product_images/'.$product->name.$i); //delete old image fromstorage
                }
                elseif($i==0) //if image dont have default image
                {
                    $updateArrayImages= ['image' => $name.'0', 'product_id' => $product->id, 'primary' => 1];
                    DB::table('products_images')->where('product_id',$id)->where('primary',1)->update($updateArrayImages);
                }
                else // there are new images to add (it means we add next image, we dont change previous ones)
                {
                    $insertArrayImages[$i] = ['image' => $name.$i, 'product_id' => $product->id, 'primary' => $prim];
                }

                $new_image='new_image'.$i;
                $image[$i] = $request->$new_image;
                $image[$i]->storeAs("public/product_images/", $name.$i);
                $image_name[$i] = $name.$i;

            }
        }

        $date_now= date("Y-m-d H:i:s");

       $updateArray = array(
           'name'=>$name,
           'description'=>$description,
           'price'=> $price,
           'amount'=>$amount,
           'updated_at'=>$date_now,
       );



       DB::table('products')->where('id',$id)->update($updateArray);
       DB::table('products_images')->insert($insertArrayImages);
        //dump($updateArrayImages);

       return redirect()->route('adminDisplayProducts');

    }

    public function addProduct()
    {
        return view('admin.addProduct',['max_images_amount'=>$this->max_images_amount]);
    }

    public function validate_product(Request $request,$index)
    {
        $rules = [];

        $customMessages = [];

        for($i=0;$i<$this->max_images_amount;$i++)
        {
            if($i==$this->max_images_amount-1 || $i<$index)
                $rules += ['new_image'.$i =>['image','mimes:jpeg,jpg,png','max:5000']];
            else
                $rules += ['new_image'.$i =>['image','mimes:jpeg,jpg,png','max:5000','required_with:new_image'.($i+1)]];

            $customMessages += ['new_image'.$i.'.required_with' => 'Zdjęcie nr '.($i+1).' jest wymagane przed zdjęciem nr '.($i+2)];
        }

        $rules += [

            'name' => ['required', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],
            'amount' => ['required', 'integer', 'min:0'],
            'description' => ['max:500'],
        ];

        $customMessages += [
            'required' => 'Pole jest wymagane',
            'name.max' => 'Nazwa nie powinna być dłuższa niż 50 znaków',
            'numeric' => 'Zły format',
            'price.min' => 'Minimalna cena to 0.00',
            'amount.integer' => 'Zły format',
            'amount.min' => 'Minimalna ilość wynosi 0',
            'integer' => 'Zły format',
            'description' => 'Maksymalna długość tekstu wynosi 500 znaków',
            'image' => 'Plik powinien nie jest obrazem',
            'mimes' => 'Dozwolone typy pliku:jpeg,jpg,png',

        ];

        $this->validate($request,$rules,$customMessages);
    }

    public function addSubmitProduct(Request $request)
    {
        $this->validate_product($request,0);

        $image =[];
        $image_name=[];

        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $amount = $request->input('amount');

        $counter=0;
        for($i=0;$i<$this->max_images_amount;$i++)
        {

            if ($request->hasFile('new_image'.$i))
            {
                $new_image='new_image'.$i;
                $image[$i] = $request->$new_image;
                $image[$i]->storeAs("public/product_images/", $name.$i);
                $image_name[$i] = $name.$i;

                $counter++;
            }
        }
        if($counter==0) //if there areno custom images
        {
            $image_name[0] = "no image.png"; //default "no image" image
        }
        //dump($image);

        $date_now= date("Y-m-d H:i:s");

        $insertArray = array(
            'name'=>$name,
            'description'=>$description,
            'price'=> $price,
            'amount'=>$amount,
            'created_at'=>$date_now,
            'updated_at'=>$date_now,


        );

        $ID=DB::table('products')->insertGetId($insertArray);
        $insertArrayImages = [];


        for($i=0;$i<$counter;$i++) //for all customimages
        {
            $prim=$i+1; //priority, positions of images

            $insertArrayImages[$i] = ['image' => $image_name[$i], 'product_id' => $ID, 'primary' => $prim];
            //dump($insertArrayImages);
        }

        if($counter==0) //if there is no custom image
        {
            $insertArrayImages[0] = ['image' => $image_name[0], 'product_id' => $ID, 'primary' => 1];
        }

        DB::table('products_images')->insert($insertArrayImages);
        return redirect()->route('adminDisplayProducts');

       // dump($insertArrayImages);
    }

    public function deleteProduct($id)
    {

        $products = Product::all();
        $product =$products->find($id);

        $products_images = Product_Images::all();
        $product_images = $products_images->where('product_id',$id);

        if($product)
        {
            foreach($product_images as $image) {
                //check if image exist


                $exists = Storage::disk("local")->exists('public/product_images/'.$image->image);

                if ($exists)
                {
                    if ($image->image != $this->no_image) // we dont delete default no image image
                    {

                        Storage::delete('public/product_images/'.$image->image);
                    }
                }
            }

            //update database
            DB::table('products')->where('id', $id)->delete();

        }

        // refreshed list
        $products = Product::with(['products_images'=>
                function($query)
                {
                    $query->where('primary', '=', '1');
                }]
        )->get();

        return view('admin.displayProducts',['products'=>$products]);

    }

    public function deleteProductImage(Request $request,$id)
    {
        $products_images = Product_Images::all();
        $image = $products_images->find($id);
        $product_id=0;

        if($image)
        {

            $product_id=$image->product_id;
            $product =Product::all()->find($product_id);

            $images_to_move = $products_images->where('product_id',$product_id)->where('primary','>',$image['primary']);
            $counter=$images_to_move->count();
            $counter2=$products_images->count();


            $exists = Storage::disk("local")->exists('public/product_images/'.$image->image);

            if ($exists)
            {
                if ($image->image != $this->no_image) // we dont delete default no image image
                {
                    Storage::delete('public/product_images/'.$image->image);
                }

            }


            if($counter==0 && $counter2==1) //if there is only one customized image
            {
                DB::table('products_images')->where('id',$image->id)->update(['image'=>$this->no_image]);
            }
            else
            {
                DB::table('products_images')->where('id', $id)->delete();
            }

            foreach($images_to_move as $img)
            {
                $level=$img->primary-1;
                $new_name=$product->name.($level-1);
                DB::table('products_images')->where('id',$img->id)->update(['image'=>$new_name,'primary'=>$level]);
                Storage::move('public/product_images/'.$img->image, 'public/product_images/'.$product->name.($level-1));
            }
            return $this->editProductsForm($product_id);
        }

        //dump($images_to_move);
        return $this->index();

    }
}
