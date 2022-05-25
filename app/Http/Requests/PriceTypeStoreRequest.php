<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceTypeStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:price_types,name',
        ];
    }
}
