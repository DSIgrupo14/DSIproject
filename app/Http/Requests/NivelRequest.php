<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NivelRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'required|max:3|unique:niveles,codigo,' . $this->route('nivel'),
            'nombre' => 'required|max:100',
        ];
    }
}
