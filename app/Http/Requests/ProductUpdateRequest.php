<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:products,name,'.$this->product->id,
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'nullable',
            'is_active' => 'boolean'
        ];
    }
}
