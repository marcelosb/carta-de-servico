<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            return [ 
                'permission' => 'required|array'
            ];
        }

        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|unique:users,email|string|email|max:255',
            'permission' => 'required|array',
            'password' => 'required|min:5|confirmed'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'permission.required' => 'Selecione pelo menos uma permissão!'
        ];
    }
}
