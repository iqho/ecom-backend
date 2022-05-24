<?php

namespace App\Http\Controllers\Category;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->get(['id','name', 'slug', 'is_active']);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);

        $imageName = NULL;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $this->_getFileName($image->getClientOriginalExtension());
            $image->move(public_path('categry-images'), $imageName);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->image = $imageName;
        $category->user_id = auth()->id();
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category Created Successfully.');;
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
      return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $this->_getFileName($image->getClientOriginalExtension());
            $image->move(public_path('categry-images'), $imageName);

            if ($product->image !== NULL) {
                if (file_exists(public_path('categry-images/'. $product->image ))) {
                    unlink(public_path('categry-images/'. $product->image ));
                }
            }

            $category->image = $imageName;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->user_id = auth()->id();
        $category->update();

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully.');
    }

    public function destroy(Category $category)
    {

        // $products = Product::where('category_id', $category->id)->count();

        // if($products > 0){
        //     Product::where('category_id', $category->id)->update(['category_id' => 1]);
        // }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully.');
    }

    public function changeStatus(Category $category)
    {
        if ($category->is_active == 1){
            $category->is_active = 0;
        }
        else {
            $category->is_active = 1;
        }

        $category->update();

        return redirect()->route('categories.index')->with('status','Category active status has been changed successfully !');
    }

    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'c-'. date("dmYhis") . '.' . $fileExtension;
    }
}
