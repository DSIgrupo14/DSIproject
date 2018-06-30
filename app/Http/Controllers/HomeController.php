<?php

namespace DSIproject\Http\Controllers;

use DSIproject\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Crea una nueva instancia de controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Actualiza imagen de perfil del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarImagen(Request $request, $id)
    {
        // Validación.
        $this->validate(request(), [
            'imagen'   => 'required|image|mimes:jpeg,png,bmp|max:2048'
        ]);

        $user = User::find($id);

        // Almacenamiento de la imagen.
        if ($request->file('imagen')) {
            $file = $request->file('imagen');

            $nombre = 'user_' . time() . '.' . $file->getClientOriginalExtension();

            $path = public_path() . '/img/users/';

            $file->move($path, $nombre);

            // Eliminación de imagen anterior.
            if (\File::exists($path . $user->imagen) && $user->imagen != 'user_default.jpg') {
                \File::delete($path . $user->imagen);
            }

            $user->imagen = $nombre;
        }

        $user->save();

        flash('
            <h4>Imagen de Perfil</h4>
            <p>La imagen de perfil se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('home');
    }

    /**
     * Actualiza contraseña del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizarPassword(Request $request, $id)
    {
        // Validación.
        $this->validate(request(), [
            'password' => 'required|min:6|max:100|confirmed',
        ]);

        $user = User::find($id);

        $user->fill($request->all());

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        flash('
            <h4>Contraseña</h4>
            <p>La contraseña se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('home');
    }
}
