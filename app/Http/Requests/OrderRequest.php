<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'quantity.min' => 'Invalid Quantity Value',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()], 422));
    }
}
