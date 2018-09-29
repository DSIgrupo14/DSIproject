<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionRequest extends FormRequest
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
            'grado_id' => 'required',
            'materia_id' => 'required',
            'trimestre' => 'required',
            'tipo' => 'required',
            'porcentaje' => 'required|numeric|min:1|max:35',
        ];
    }
}
