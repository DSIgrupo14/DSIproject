<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradoRequest extends FormRequest
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
            'nivel_id'   => 'required',
            'anio_id'    => 'required',
            'docente_id' => 'required',
            'seccion'    => 'max:1',
        ];
    }
}
