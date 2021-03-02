<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserProfileRequest extends FormRequest
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
            'id' => 'integer|required',
            'name' => 'required|min:2|max:255',
            'avatar' => 'image|mimes:jpg,jpeg,png',
            'email' => [
                'email',
                'required',
                Rule::unique('users')->ignore($this->id),
            ],
        ];
    }
}
