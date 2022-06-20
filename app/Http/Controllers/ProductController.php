<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function get_all_product()
    {
        return response()->json([
            'products' => Product::all()
        ], 200);
    }
}
