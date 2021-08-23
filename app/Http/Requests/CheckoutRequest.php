<?php

namespace App\Http\Requests;
use Sentinel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class CheckoutRequest extends FormRequest
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
        $emailValidation = Sentinel::getUser() ? 'required|email' : 'required|email|unique:users';

        return [
            'email' => $emailValidation,
            'name' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        
    }
}
