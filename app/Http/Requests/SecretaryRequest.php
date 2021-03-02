<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SecretaryRequest extends FormRequest
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
            $id = $this->route()->parameter('secretary');
            return [
                'theme' => 'required|min:2|max:255',
                'address' => 'required|min:10|max:255',
                'telephone' => 'required|min:9|max:255',
                'email' => 'nullable|email|min:6',
                'opening_hours' => 'required|min:2|max:255',
                'image_secretary' => 'image|mimes:jpg,jpeg,png',
                'name' => [
                    'required',
                    'min:5',
                    'max:255',
                    Rule::unique('secretaries')->ignore($id)
                ],
            ];
        }

        return [
            'name' => 'required|unique:secretaries,name|min:5|max:255',
            'theme' => 'required|min:2|max:255',
            'address' => 'required|min:10|max:255',
            'telephone' => 'required|min:9|max:255',
            'email' => 'nullable|email|min:6',
            'opening_hours' => 'required|min:2|max:255',
            'image_secretary' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'nome da secretaria',
            'theme' => 'tema',
            'telephone' => 'telefone',
            'opening_hours' => 'horário de atendimento',
        ];
    }

}
