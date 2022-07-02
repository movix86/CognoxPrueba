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
            'name' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'numeric', 'min:111', 'max:9999', 'confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre de curso',
            'description' => 'Resumen',
            'tittle_activation' => 'Titulo activacion',
            'url_path_image_course' => 'Banner',
            'url_path_image_course_btn' => 'Boton',
            'code_block' => 'Caja de texto HTML',
            'type' => 'Tipo de curso',
            'category' => 'Categoria'
        ];
    }
}
