<?php

namespace DSIproject\Http\Controllers;

use DSIproject\Http\Requests\UserRequest;
use DSIproject\User;
use DSIproject\Rol;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Muestra una lista de usuarios.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $users = User::where('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('apellido', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('email', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('dui', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }

        return view('users.index')
            ->with('users', $users)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('users.create')->with('roles', $roles);
    }

    /**
     * Almacena un usuario recién creado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Almacenamiento de la imagen.
        if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombre = 'user_' . time() . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/img/users/';

            $file->move($path, $nombre);
        } else {
            $nombre = "user_default.jpg";
        }

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->imagen = $nombre;
        $user->estado = 1;

        $user->save();

        flash('
            <h4>Registro de Usuario</h4>
            <p>El usuario <strong>' . $user->nombre . ' ' . $user->apellido . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('users.index');
    }

    /**
     * Muestra el usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user || $user->estado == 0) {
            abort(404);
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Muestra el formulario para editar el usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (!$user || $user->estado == 0) {
            abort(404);
        }

        $roles = Rol::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    /**
     * Actualiza el usuario especificado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\RolRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        if (!$user || $user->estado == 0) {
            abort(404);
        }

        // Almacenamiento de la imagen.
        if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombre = 'user_' . time() . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/img/users/';

            $file->move($path, $nombre);

            // Eliminación de la imagen anterior.
            if (\File::exists($path . $user->imagen) && $user->imagen != 'user_default.jpg') {
                \File::delete($path . $user->imagen);
            }
        } else {
            $nombre = $user->imagen;
        }

        $user->fill($request->all());
        $user->imagen = $nombre;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        flash('
            <h4>Edición de Usuario</h4>
            <p>El usuario <strong>' . $user->nombre . ' ' . $user->apellido . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('users.index');
    }

    /**
     * Da de baja al usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user || $user->estado == 0) {
            abort(404);
        }

        $user->estado = 0;

        $user->save();

        flash('
            <h4>Baja de Usuario</h4>
            <p>El usuario <strong>' . $user->nombre . ' ' . $user->apellido . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('users.index');
    }
}