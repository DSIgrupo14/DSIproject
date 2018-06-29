<?php

namespace DSIproject\Http\Requests;

use DSIproject\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user = User::find($this->route('user'));

        $rules = array(
            'rol_id'   => 'required',
            'nombre'   => 'required|max:100',
            'apellido' => 'required|max:100',
            'email'    => 'required|max:100|email|unique:users,email,' . $this->route('user'),
            'password' => 'max:100|confirmed',
            'dui'      => 'required|min:10|max:10|unique:users,dui,' . $this->route('user'),
            'imagen'   => 'image|mimes:jpeg,png,bmp|max:2048',
        );

        if ($user == null) {
            $rules['password'] .= '|required|min:6';
        }

        return $rules;
    }
}
