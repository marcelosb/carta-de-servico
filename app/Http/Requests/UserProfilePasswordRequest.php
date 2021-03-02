<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfilePasswordRequest extends FormRequest
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
            'password_current' => 'required|min:8|password',
            'new_password' => 'required|min:8|confirmed',
        ];
    }

    /**
     * Customiza os atributos para validação de erros.
     * 
     * @return array
     */
    public function attributes()
    {
       return [
           'password_current' => 'senha atual',
           'new_password' => 'nova senha'
       ];
    }

}
