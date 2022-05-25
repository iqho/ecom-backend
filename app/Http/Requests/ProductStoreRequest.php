<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable',
            'is_active' => 'in:0,1',
        ];
    }
}
