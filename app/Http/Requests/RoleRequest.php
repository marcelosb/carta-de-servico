<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
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
            $id = $this->route()->parameter('role');
            return [
                'name' => [
                    'required',
                    'string',
                    'min:2',
                    'max:255',
                    Rule::unique('roles')->ignore($id)
                ],
                'description' => 'required|string|min:2|max:255',
                'permission' => 'required|array'
            ];
        }

        return [
            'name' => 'required|unique:roles,name|string|min:2|max:255',
            'description' => 'required|string|min:2|max:255',
            'permission' => 'required|array'
        ];
    }
}
