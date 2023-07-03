<?php

namespace App\Http\Controllers\admin;

use App\Custom_Images;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class CustomImagesController extends Controller
{
    public $max_images_amount=5;
    public $no_image='no image.png';

    public function editSliders()
    {
        $custom_images = Custom_Images::all();

        return view('admin.editMainPageImages',[
            'custom_images'=>$custom_images,
            'max_images_amount'=>$this->max_images_amount]);
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

        $customMessages += [
            'required' => 'Pole jest wymagane',
            'image' => 'Plik powinien nie jest obrazem',
            'mimes' => 'Dozwolone typy pliku:jpeg,jpg,png',

        ];
        $this->validate($request,$rules,$customMessages);
    }

    public function storeSliders(Request $request)
    {

        $name='tlo';

        $insertArrayImages=[];  //list of images to update
        $updateArrayImages=[]; //we update only primary image (first) and it hasnt default image

        $custom_images = Custom_Images::all();
        $count = $custom_images->count();
        $count2 = $custom_images->where('image',$this->no_image)->count();

        if($count2==1){$count--;} //if there is only one image and is default timage (no image.jpg)

        $this->validate_product($request,$count); //we changing validation rules

        for($i=0;$i<$this->max_images_amount;$i++) // iteration by image fields
        {
            $prim=$i+1;
            if ($request->hasFile('new_image'.$i)) //if there is image loaded in field
            {

                //if image name representing name of product exist in storage it means we have image name in database we only change image in storage leaving the same name
                $exist = Storage::disk('local')->exists('public/other_images/'.$name.$i);

                // if image exist and has set name
                if($exist)
                {

                    $updateArrayImages= ['updated_at'=>now()];
                    Custom_Images::where('primary',($i+1))->update($updateArrayImages);

                    if($i==0) {$prim=1;} //if we are changing first image(primary image)
                    {
                        Storage::delete('public/other_images/' . $name . $i); //delete old image from storage
                    }

                }
                elseif($i==0 && $count2==1) //if image dont have default image
                {
                    $updateArrayImages= ['image' => $name.'0', 'primary' => 1,'updated_at'=>now()];
                    Custom_Images::where('primary',1)->update($updateArrayImages);
                }
                else // there are new images to add (it means we add next image, we dont change previous ones)
                {
                    $insertArrayImages[$i] = ['image' => $name.$i, 'primary' => $prim,'created_at'=>now()];
                }

                $new_image='new_image'.$i;
                $image[$i] = $request->$new_image;
                $image[$i]->storeAs("public/other_images/", $name.$i);
                $image_name[$i] = $name.$i;

            }
        }

        Custom_Images::insert($insertArrayImages);
        //dump($insertArrayImages);


        return redirect()->route('getProducts');

    }

    public function deleteSlider($id)
    {

        $name='tlo';

        $images = Custom_Images::all();
        $image =$images->find($id);

        $images_to_move = $images->where('primary','>',$image['primary']);
        $counter=$images_to_move->count();
        $counter2=$images->count();

        if($image)
        {
            $exists = Storage::disk("local")->exists('public/other_images/'.$image->image);

            if($exists)
            {
                if ($image->image != $this->no_image) // we dont delete default no image image
                {
                    Storage::delete('public/other_images/'.$image->image);
                }

            }

            if($counter==0 && $counter2==1) //if there is only one customized image
            {
                Custom_Images::where('id',$image->id)->update(['image'=>$this->no_image]);
            }
            else
            {
                Custom_Images::where('id', $id)->delete();
            }

            foreach($images_to_move as $img)
            {
                $level=$img->primary-1;
                $new_name=$name.($level-1);
                Custom_Images::where('id',$img->id)->update(['image'=>$new_name,'primary'=>$level]);
                Storage::move('public/other_images/'.$img->image, 'public/other_images/'.$new_name);
            }
        }

        //dump($images_to_move);
        return $this->editSliders();
    }



}

