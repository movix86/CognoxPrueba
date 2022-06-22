<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendFormValidator extends FormRequest
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
            'origen' => 'required|integer',
            // 'referencia' => 'required|max:255|unique:referencia',
            'destino' => 'required|max:255',
            'cantidad' => 'required|max:255'
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'origen' => 'Seleccione una cuenta de origen',
    //         'destino' => 'Destino: Escriba el numero',
    //         'cantidad' => 'Cantidad: Ingrese la cantidad'
    //     ];
    // }
}
