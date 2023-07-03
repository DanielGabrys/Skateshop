<?php

namespace App\Http\Controllers\admin;

use App\Attributes;
use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Categories;
use Illuminate\Support\Facades\Session;

class AdminCategoriesController extends Controller
{

    public function separateCategories($cat)
    {
        $categories = Categories::orderBy('path')->get();

        foreach ($cat as $ca)
        {
           for($i=1;$i<strlen($ca->path);$i++)
           {
               if($ca->path[$i]=='/')
               {
                   $ca->category="~".$ca->category;
               }
           }
        }

    }

    public function getparent($cat)
    {

        foreach ($cat as $ca)
        {
            $parent = Categories::where('id',$ca->parent_category)->value('category');
            if($parent!=NULL)
                $ca->parent_category=$parent;
            else
                $ca->parent_category="-";

        }

    }


    public function index()
    {
        $categories = Categories::orderBy('path')->get();

        $this->separateCategories($categories);
        $this->getparent($categories);

        return view('admin.displayCategories', ['categories' => $categories]);
    }

    public function validate_category(Request $request)
    {

        $rules = [
            'name' => ['required','min:2','max:50', 'string','unique:categories,category'],
            'parent' => ['required'],
        ];

        $customMessages = [
            'required' => 'Pole jest wymagane',
            'name.max' => 'Nazwa nie powinna być dłuższa niż 50 znaków',
        ];

        $this->validate($request,$rules,$customMessages);
    }

    public function addCategoryForm()
    {
        $categories = Categories::orderBy('category')->get();

        $attributes = Session::get('categories');
        return view('admin.addCategory',['attributes'=>$attributes,'categories' => $categories]);

    }

    public function addCategory(Request $request)
    {

        $categories = Categories::orderBy('category')->get();
        $prevCategories = $request->session()->get('categories');

        if($prevCategories==NULL)
        {
            $request->session()->put('categories',1);
        }
        else
        {
            $request->session()->increment('categories');
        }

        return view('admin.addCategory',['attributes'=>$prevCategories+1,'categories' => $categories]);
    }

    public function storeCategory(Request $request)
    {

        $insertArrayAttribute=[];
        $insertArrayParentAttributes=[];
        $counter = $request->session()->get('categories');

        $name = $request->input('name');
        $parent=$request->input('parent');

        $categories=Categories::all();
        $parent_cat=$categories->where('category',$parent)->first(); //finding parent category
        if($parent_cat==null)
        {
            $parent_id=0;
            $new_path='/'.$name;
            $new_level=0;


        }
        else
        {
            $parent_id= $parent_cat->id; //id parent category
            $parent_path=$parent_cat->path; //path parent category

            $new_path=$parent_path.'/'.$name; //path for new category
            $new_level=$parent_cat->level +1;
        }

            $this->validate_category($request);

            $insertArray = array
            (
                'category'=>$name,
                'parent_category'=>$parent_id,
                'path'=>$new_path,
                'level'=>$new_level
            );

            DB::beginTransaction();

            $ID=DB::table('categories')->insertGetId($insertArray);


            if(!$ID){DB::rollBack();}

             DB::commit();

        return $this->index($request);

    }

    public function deleteCategory($id)
    {
        Categories::findOrFail($id)->delete();

        return $this->index();
    }

}


