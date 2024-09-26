<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRepuset extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string|max:500',
            'phone' => 'required|string|max:15',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }
}
