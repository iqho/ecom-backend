<?php

namespace App\Http\Controllers\PriceType;

use App\Models\PriceType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PriceTypeStoreRequest;
use App\Http\Requests\PriceTypeUpdateRequest;

class PriceTypeController extends Controller
{
    private $_getColumns = (['id', 'name', 'slug', 'user_id', 'is_active']);

    public function index()
    {
        $priceTypes = PriceType::idDescending()->get($this->_getColumns);

        return view('price-types.index', compact('priceTypes'));
    }

    public function create()
    {
        return view('price-types.create');
    }

    public function store(PriceTypeStoreRequest $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:price_types',
            'is_active' => 'boolean'
        ]);

        $pType = new PriceType;
        $pType->name = $request->name;
        $pType->slug = Str::slug($request->name);
        $pType->user_id = auth()->id();
        $pType->save();

        return redirect()->route('priceType.index')->with('success', 'Product Price Type Created Successfully.');;
    }

    public function edit(PriceType $priceType)
    {
        //return $priceType;
        return view('price-types.edit', compact('priceType'));
    }

    public function update(PriceTypeUpdateRequest $request, PriceType $priceType)
    {
        $priceType->name = $request->name;
        $priceType->slug = Str::slug($request->name);
        $priceType->user_id = auth()->id();
        $priceType->update();

        return redirect()->route('priceType.index')->with('success', 'Product Price Type Updated Successfully.');
    }

    public function destroy(PriceType $priceType)
    {
        $priceType->delete();

        return redirect()->route('priceType.index')->with('success', 'Product Price Type Deleted Successfully.');
    }

    public function changeStatus(Request $request)
    {
        $ptype = PriceType::find($request->id);
        $ptype->is_active = $request->status;
        $ptype->save();

        return response()->json(['success' => 'Price Type Active Status Change Successfully.']);
    }
}
