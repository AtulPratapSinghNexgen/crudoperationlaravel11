<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Products::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {

        return view('products.create');
    }

    public function store(Request $req)
    {
        $rules = [

            'name' => 'required|unique:products|min:5',
            'sku' => 'required|min:3|unique:products',
            'price' => 'required|numeric'
        ];

        if($req->image != "")
        {
            $rules['image'] = 'image';
        }
       $validator = Validator::make($req->all(), $rules);

       if($validator->fails())
       {

        return redirect()->route('products.create')->withInput()->withErrors($validator);
       }

       //here we insert the data into the database
       $product = new Products();

       $product->name = $req->name;
       $product->sku = $req->sku;
       $product->price = $req->price;
       $product->description = $req->description;
       $product->save();

       //when the image code excute
       if($req->image != "")
       {
        //store the image now
        $image = $req->image;

        $ext = $image->getClientOriginalExtension();
        $imageName = time(). '.'.$ext; //unique image name

        //save image to any folder
        $image->move(public_path('uploads'), $imageName);

        $product->image = $imageName;

        $product->save();
       }
       
       
       return redirect()->route('products.index')->with('success', 'Product Added Successfully!!!');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
