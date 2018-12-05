<?php

namespace DSIproject\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use DSIproject\Anio;
use DSIproject\Docente;
use DSIproject\Grado;
use DSIproject\Http\Requests\GradoRequest;
use DSIproject\Nivel;
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
        $docentes = Docente::orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        return view('grados.create')
                ->with('niveles', $niveles)
                ->with('anios',$anios)
                ->with('docentes',$docentes);
    }

    /**
     * Store a newly created resource in storage. \DSIproject\Http\Requests\UserRequest
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradoRequest $request)
    {
        $nivel = Nivel::find($request->nivel_id);
        $anio = Anio::find($request->anio_id);

        // Validando registro único.
        if (!$this->esUnico($request->nivel_id, $request->anio_id, $request->seccion)) {
             flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>Ya existe el grado.</p>
            ')->error()->important();

             return back();
         }

        $grado = new Grado($request->all());
        $grado->estado = 1;

        if ($request->seccion) {
            $grado->codigo = $nivel->codigo . '-' . $request->seccion . '-' . $anio->numero;
        } else {
            $grado->codigo = $nivel->codigo . '-' . $anio->numero;
        }

        $grado->save();

        // Almacenando las materias impartidas en el grado.
        $materias = $nivel->materias;

        if ($grado->nivel->orientador_materia == 1) {
            $docente = $grado->docente_id;

            $form_extra = false;
        } else {
            $docente = null;

            $form_extra = true;
        }

        foreach ($materias as $materia) {
            $grado->materias()->attach($materia->id, ['docente_id' => $docente]);
        }

        flash('
            <h4>Registro de Grado</h4>
            <p>El Grado <strong>' . $grado->codigo . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        if ($form_extra) {
            return redirect()->route('grados.edit', $grado->id);
        } else {
            return redirect()->route('grados.index');
        }
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
        $docentes = Docente::orderBy('id', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        $materias = $grado->materias;

        return view('grados.edit')
            ->with('grado', $grado)
            ->with('niveles', $niveles)
            ->with('anios',$anios)
            ->with('docentes',$docentes)
            ->with('materias', $materias);
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

        // Almacenando las materias impartidas en el grado.
        for ($i=0; $i < count($request->materias); $i++) { 
            $grado->materias()->updateExistingPivot($request->materias[$i], ['docente_id' => $request->docentes[$i]]);
        }

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
            <h4>Baja de Grado</h4>
            <p>El Grado<strong>' . $grado->codigo .  '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('grados.index');
    }



public function pdf(Request $request)
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

        return view('grados.pdf')
            ->with('grados', $grados)
            ->with('searchText', $query);
    }

    /**
     * Verifica que el grado sea único.
     *
     * @param  int  $nivel
     * @param  int  $anio
     * @param  string  $seccion
     * @return bool
     */
    public function esUnico($nivel, $anio, $seccion)
    {
        $grado = Grado::where('nivel_id', $nivel)
            ->where('anio_id', $anio)
            ->where('seccion', $seccion)
            ->first();

        if ($grado) {
            return false;
        } else {
            return true;
        }
    }
}
