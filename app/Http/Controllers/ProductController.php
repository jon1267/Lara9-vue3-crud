<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Image;

class ProductController extends Controller
{
    public function get_all_product()
    {
        return response()->json([
            'products' => Product::all(),
        ], 200);
    }

    public function add_product(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;

        if ($request->photo != "") {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0 , $position);
            $ext = explode('/', $sub[1]);
            $name = time() . '.' . $ext;
            $img = Image::make($request->photo)->resize(200,200);
            $upload_path = public_path()."/upload/";
            $img->save($upload_path . $name);
            $product->photo = $name;
        } else {
            $product->photo = "image.png";
        }

        $product->photo = $name;
        $product->type = $request->type;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->save();
    }
}
