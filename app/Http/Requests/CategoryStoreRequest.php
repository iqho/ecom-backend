<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:categories,name',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ];
    }
}
