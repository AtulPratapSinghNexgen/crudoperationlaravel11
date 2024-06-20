<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Products;
use File;
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

    public function edit($id)
    {
        $product = Products::findOrFail($id);
        
        return view('products.edit', ['product'=>$product]);
    }

    public function update($id, Request $req)
    {
        $product = Products::findOrFail($id);
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

        return redirect()->route('products.edit', $product->p_id)->withInput()->withErrors($validator);
       }

       //here we update the data into the database
     
       $product->name = $req->name;
       $product->sku = $req->sku;
       $product->price = $req->price;
       $product->description = $req->description;
       $product->save();

       //when the image code excute
       if($req->image != "")
       {
        //delete old image
        File::delete(public_path('uploads/'.$product->image));
        //store the image now
        $image = $req->image;

        $ext = $image->getClientOriginalExtension();
        $imageName = time(). '.'.$ext; //unique image name

        //save image to any folder
        $image->move(public_path('uploads'), $imageName);

        $product->image = $imageName;

        $product->save();
       }
       
       
       return redirect()->route('products.index')->with('success', 'Product Updated Successfully!!!');
    }

    public function delete($id)
    {
        $product = Products::findOrFail($id);
        File::delete(public_path('uploads/'.$product->image));

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted SuccessFully!!!');
    }
}
