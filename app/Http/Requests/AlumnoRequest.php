<?php

namespace DSIproject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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
            'nombre'           => 'required|max:100',
            'apellido'         => 'required|max:100',
            'nie'              => 'required|max:6|unique:alumnos,nie,' . $this->route('alumno'),
            'fecha_nacimiento' => 'required',
            'genero'           => 'required',
            'municipio_id'     => 'required',
            'direccion'        => 'max:400',
            'telefono'         => 'required|max:8',
            'responsable'      => 'required|max:200',
        ];
    }
}
