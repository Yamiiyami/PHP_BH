<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\TryCatch;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|digits_between:10,15',
            'status' => 'nullable|in:enable,unable',
            'role_id' => 'required|exists:roles,id'
        ];
    }
}
