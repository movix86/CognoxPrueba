<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserValidator extends FormRequest
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
        return [
            'name' => 'required|max:255',
            // 'referencia' => 'required|max:255|unique:referencia',
            'documento' => 'required|integer|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }
}
