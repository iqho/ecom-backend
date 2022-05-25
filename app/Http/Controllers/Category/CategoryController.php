<?php

namespace App\Http\Controllers\Category;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{

    private $_getColumns = (['id', 'name', 'slug', 'user_id', 'image', 'is_active']);

    public function index()
    {
        $categories = Category::with('users')->orderBy('id', 'ASC')->get($this->_getColumns);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $imageName = NULL;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $this->_getFileName($image->getClientOriginalExtension());
            $image->move(public_path('category-images'), $imageName);
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

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $this->_getFileName($image->getClientOriginalExtension());
            $image->move(public_path('category-images'), $imageName);

            if ($category->image !== NULL) {
                if (file_exists(public_path('category-images/'. $category->image ))) {
                    unlink(public_path('category-images/'. $category->image ));
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

        $products = Product::where('category_id', $category->id)->count();

        if($products > 0){
            Product::where('category_id', $category->id)->update(['category_id' => null]);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category Deleted Successfully.');
    }

    public function changeStatus(Category $category)
    {
        $category->is_active = !$category->is_active;
        $category->update();

        return redirect()->route('categories.index')->with('status','Category active status has been changed successfully !');
    }

    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'c-'. date("dmYhis") . '.' . $fileExtension;
    }
}
