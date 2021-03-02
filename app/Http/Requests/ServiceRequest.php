<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ServiceRequest extends FormRequest
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
            'secretary_id' => 'required|integer',
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'content' => 'required|min:10',
            'icon' => 'required'
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
            'secretary_id.integer' => 'Selecione uma secretaria!'
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
            'secretary_id' => 'id da secretaria',
            'name_slug' => 'slug da variável nome'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name_slug' => Str::slug($this->name, '-'),
            'icon' => 'default.svg'
        ]);
    }

}
