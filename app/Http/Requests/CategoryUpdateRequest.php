<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_active' => 'boolean'
        ];
    }
}
