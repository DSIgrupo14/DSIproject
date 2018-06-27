<?php

namespace DSIproject\Http\Controllers;

use DSIproject\Rol;
use DSIproject\Http\Requests\RolRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class RolController extends Controller
{
    /**
     * Muestra una lista de roles de usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $roles = Rol::where('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('codigo', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }

        return view('roles.index')
            ->with('roles', $roles)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo rol de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Almacena un rol de usuario recién creado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\RolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        $rol = new Rol($request->all());
        $rol->estado = 1;

        $rol->save();

        flash('
            <h4>Registro de Rol de Usuario</h4>
            <p>El rol de usuario <strong>' . $rol->nombre . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('roles.index');
    }

    /**
     * Muestra el formulario para editar el rol de usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);

        if (!$rol || $rol->estado == 0) {
            abort(404);
        }

        return view('roles.edit')->with('rol', $rol);
    }

    /**
     * Actualiza el rol de usuario especificado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\RolRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        $rol = Rol::find($id);

        if (!$rol || $rol->estado == 0) {
            abort(404);
        }
        
        $rol->fill($request->all());
        
        $rol->save();

        flash('
            <h4>Edición de Rol de Usuario</h4>
            <p>El rol de usuario <strong>' . $rol->nombre . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('roles.index');
    }

    /**
     * Da de baja al rol de usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol || $rol->estado == 0) {
            abort(404);
        }

        $rol->estado = 0;

        $rol->save();

        flash('
            <h4>Baja de Rol de Usuario</h4>
            <p>El rol de usuario <strong>' . $rol->nombre . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('roles.index');
    }
}
