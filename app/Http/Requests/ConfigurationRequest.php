<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ConfigurationRequest extends FormRequest
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
            'website_title' => 'required|string|min:5|max:255',
            'logo' => 'image|mimes:jpg,jpeg,png',
            'favicon' => 'image|mimes:jpg,jpeg,png'
        ];
    }

    public function attributes()
    {
        return [
            'website_title' => 'título do site'
        ];
    }
}
