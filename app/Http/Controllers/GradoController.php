<?php

namespace DSIproject\Http\Controllers;

use Illuminate\Http\Request;
use DSIproject\Grado;
use DSIproject\Nivel;
use DSIproject\Anio;
use DSIproject\Docente;
use DSIproject\User;
use Laracasts\Flash\Flash;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         if ($request) {
            $query = trim($request->get('searchText'));

            $grados = Grado::where('estado', 1)
                ->where('codigo', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('seccion', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('grados.index')
            ->with('grados', $grados)
            ->with('searchText', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveles = Nivel::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $anios = Anio::orderBy('numero', 'asc')->pluck('numero', 'id');
        $docentes = Docente::orderBy('id', 'asc')->pluck('id', 'user_id');  

        return view('grados.create')
                ->with('niveles', $niveles)
                ->with('anios',$anios)
                ->with('docentes',$docentes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grado = new Grado($request->all());
        $grado->estado = 1;

        $grado->save();

        flash('
            <h4>Registro de Grado</h4>
            <p>El Grado <strong>' . $grado->codigo . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('grados.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grado = Grado::find($id);

        if (!$grado || $grado->estado == 0) {
            abort(404);
        }

        $niveles = Nivel::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $anios = Anio::orderBy('numero', 'asc')->pluck('numero', 'id');
        $docentes = Docente::orderBy('id', 'asc')->pluck('id', 'user_id');  

        return view('grados.edit')
            ->with('grado', $grado)
            ->with('niveles', $niveles)
            ->with('anios',$anios)
            ->with('docentes',$docentes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $grado = Grado::find($id);

        if (!$grado || $grado->estado == 0) {
            abort(404);
        }
        
        $grado->fill($request->all());
        
        $grado->save();

        flash('
            <h4>Edición de Docente</h4>
            <p>El docente <strong>' . $grado->codigo . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('grados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $grado = Grado::find($id);

        if (!$grado || $grado->estado == 0) {
            abort(404);
        }

        $grado->estado = 0;

        $grado->save();

        flash('
            <h4>Baja de Usuario</h4>
            <p>El Grado<strong>' . $grado->codigo .  '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('grados.index');
    }
}
