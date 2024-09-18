<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        // lấy parameter trên url vd: (http://customer/4) => $id = 4
        $id = $this->route('customer');
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username,'.$id, 
            'email' => 'required|email|unique:customers,email,'.$id,
            'password' => 'nullable|string|min:6',
            'status' => 'nullable|in:enable,unable',
            'phone' => 'required|digits_between:10,15',
            'role_id' => 'nullable|exists:roles,id'
        ];
    }
}
