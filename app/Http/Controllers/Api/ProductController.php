<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $_getColumns = (['id', 'name', 'slug', 'description', 'category_id', 'image']);

    public function index()
    {
        $products = Product::with('category', 'productPrices')->idDescending()->get($this->_getColumns);
        $categories = Category::with('products')->get();

        return response()->json([
            'product' => $products,
            'categories' => $categories
        ], 200);
    }

    public function show(Product $api_product)
    {
        $product = Product::with('category', 'productPrices')->find($api_product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }

    public function getSingleCategory(Category $category)
    {
        $category = Category::with('products')->find($category->id);
        return response()->json([
            'message' => "Category Showed Successfully!!",
            'category' => $category
        ], 200);
    }
}
