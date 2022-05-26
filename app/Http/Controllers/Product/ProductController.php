<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\PriceType;
use Illuminate\Support\Str;
use App\Models\ProductPrice;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{

    private $_getColumns = (['id', 'name', 'slug', 'category_id', 'user_id', 'image', 'is_active']);

    public function index()
    {
        $viewBag['products'] = Product::idDescending()->get($this->_getColumns);

        return view('products.index', $viewBag);
    }


    public function create()
    {
        $categories = Category::where('is_active', 1)->Orderby('id', 'DESC')->get(['id', 'name']);
        $price_types = PriceType::where('is_active', 1)->Orderby('id', 'ASC')->get(['id', 'name']);

        return view('products.create', compact('categories', 'price_types'));
    }

    public function store(ProductStoreRequest $request)
    {

        try {

            $imageName = null;

            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);
            }

            $product = new Product;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->image = $imageName;
            $product->user_id = auth()->id();
            $product->save();

            // Product Price Type Store
            $getAllPrices = $request->price;
            $price_type_id = $request->price_type_id;
            $start_date = $request->start_date;

            $values = [];

            foreach ($getAllPrices as $index => $price) {
                $values[] = [
                    'product_id' => $product->id,
                    'amount' => $price,
                    'price_type_id' => $price_type_id[$index],
                    'start_date' => $start_date[$index],
                ];
            }

            if ( ($price !== NULL) && ($price_type_id[$index] !== NULL) ){
                $product->productPrices()->insert($values);
            }

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];

            if ($errorCode == 1062) {
                return redirect()->back()->withErrors(['msg' => 'This product name already exits under selected category']);
            } else {
                return redirect()->back()->withErrors(['msg' => 'Unable to process request.Error:' . json_encode($e->getMessage(), true)]);
            }

        }

        return redirect()->route('products.index')->with('success', 'Product Created Successfully.');
    }

    public function show(Product $product)
    {
        $viewBag['product'] = $product;

        return view('products.show', $viewBag);
    }

    public function edit(Product $product)
    {
        $viewBag['product'] = $product;
        $viewBag['categories'] = $this->_getCategories();
        $viewBag['price_types'] = PriceType::where('is_active', 1)->Orderby('id', 'ASC')->get(['id', 'name']);

        return view('products.edit', $viewBag);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $this->_getFileName($image->getClientOriginalExtension());
                $image->move(public_path('product-images'), $imageName);

                if ($product->image !== NULL) {
                    if (file_exists(public_path('product-images/'. $product->image ))) {
                        unlink(public_path('product-images/'. $product->image ));
                    }
                }

                $product->image = $imageName;
            }

            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->user_id = auth()->id();
            $product->update();

            // Product Price Type Update
            $product_price_id = $request->product_price_id;

            if($product_price_id){
                for ($i = 0; $i < count($product_price_id); $i++) {

                    $values = [
                        'product_id' => $product->id,
                        'amount' => $request->amount[$i],
                        'price_type_id' => $request->price_type_id[$i],
                        'start_date' => $request->start_date[$i],
                    ];

                    $check_id = ProductPrice::find($product_price_id[$i]);

                    if ($check_id) {
                        $product->productPrices()->where('id', $check_id->id)->update($values);
                    }
                }
            }

            $price_type_new_id = $request->price_type_new_id;

            if($price_type_new_id){
                for ($i = 0; $i < count($price_type_new_id); $i++) {
                    $values2 = [
                        'product_id' => $product->id,
                        'amount' => $request->new_amount[$i],
                        'price_type_id' => $request->price_type_new_id[$i],
                        'start_date' => $request->new_start_date[$i],
                    ];

                    if ( ($request->new_amount[$i] !== NULL) && ($request->price_type_new_id[$i] !== NULL) ){
                      $product->productPrices()->insert($values2);
                    }
                }
            }


        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->withErrors(['msg' => 'This product name already exits under selected category']);
            } else {
                return redirect()->back()->withErrors(['msg' => 'Unable to process request.Error:' . json_encode($e->getMessage(), true)]);
            }
        }

        return redirect()->route('products.index')->with('status', 'Product has been Updated Successfully.');
    }

    public function destroy(Product $product)
    {
       $product->delete();

       return redirect()->route('products.index')->with('status','Product has been Deleted Successfully !');
    }

    public function priceListDestroy($price_id)
    {
        $price = ProductPrice::find($price_id);
        $price->delete();

        return response()->json([
            'success' => 'Product Price Deleted Successfully !'
        ]);
    }

    public function changeStatus(Product $product)
    {
        if ($product->is_active == 1){
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }

        $product->update();

        return redirect()->route('products.index')->with('status','Product Active Status has been Changed Successfully !');
    }

    public function trashedIndex()
    {
        $viewBag['products'] = Product::onlyTrashed()->idDescending()->get($this->_getColumns);

        return view('products.trashed-index', $viewBag);
    }

    public function trashedRestore($id)
    {
        Product::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('products.index')->with('status','Product has been Restore Successfully !');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        $image = $product->image;

        if($image){
            if (file_exists(public_path('product-images/'. $product->image ))) {
                unlink(public_path('product-images/'. $product->image ));
            }
        }
        $product->productPrices()->where('product_id', $product->id)->forceDelete();

        $product->forceDelete();

        return redirect()->route('products.index')->with('status','Product has been Parmanently Deleted Successfully !');
    }

    // Get Categories
    private function _getCategories(){
        return Category::active()->get(['id', 'name']);
    }

    // Get File Name
    private function _getFileName($fileExtension){

        // Image name format is - p-05042022121515.jpg
        return 'p-'. date("dmYhis") . '.' . $fileExtension;
    }

}
