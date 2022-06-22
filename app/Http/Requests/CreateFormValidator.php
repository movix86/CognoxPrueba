<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormValidator extends FormRequest
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
            'email' => 'required|max:255',
            'cuenta' => 'required|integer',
            'saldo' => 'required|integer'
        ];
    }
}
