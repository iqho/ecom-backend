<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // private $_getColumns = (['id', 'name', 'slug', 'description', 'category_id', 'image']);

    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function show(Category $api_category)
    {
        $category = Category::with('products')->find($api_category->id);
        return response()->json([
            'message' => "Category Showed Successfully!!",
            'category' => $category
        ], 200);
    }
}
