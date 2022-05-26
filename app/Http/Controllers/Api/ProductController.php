<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','productPrices')->get();

        return response()->json([
            'product' => $products
        ], 200);
    }

    public function show(Product $api_product)
    {
        $product = Product::with('category','productPrices')->find($api_product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }

}
