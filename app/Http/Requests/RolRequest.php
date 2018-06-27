<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
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
        $rules = array(
            'codigo' => '',
            'nombre' => 'required|max:100',
        );

        if ($this->route('role') == null) {
            $rules['codigo'] .= 'required|max:5|unique:roles,codigo,' . $this->route('role');
        }

        return $rules;
    }
}
