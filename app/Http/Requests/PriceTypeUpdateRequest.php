<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceTypeUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:price_types,name,'.$this->priceType->id,
        ];
    }
}
