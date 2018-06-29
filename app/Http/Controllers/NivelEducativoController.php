<?php

namespace DSIproject\Http\Controllers;

use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\Facade as PDF;
use DSIproject\Http\Requests\NivelRequest;
use DSIproject\Materia;
use DSIproject\Nivel;
use Illuminate\Http\Request;

class NivelEducativoController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $nivel = Nivel::where('estado', 1)
               
                ->where('codigo', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->where('orientador_materia', 'like', '%' . $query . '%')
                
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('nivel.index')
            ->with('nivel', $nivel)
            ->with('searchText', $query);
        //$docentes = Docente::orderBy('id','ASC')->paginate(25);
        //return view('docente.index')->with('docentes', $docentes);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materias = Materia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('nivel.create')->with('materias', $materias);
    }

    /**
     * Almacena un docente en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NivelRequest $request)
    {
        $nivel = new Nivel($request->all());

        $nivel->estado = 1;

        if ($request->orientador_materia == 1) {
            $nivel->orientador_materia = 1;
        } else {
            $nivel->orientador_materia = 0;
        }

        $nivel->save();

        // Almacenamiento de materias impartidas en el nivel educativo.
        $nivel->materias()->sync($request->materias);

        flash('
            <h4>Registro de Nivel Educativo</h4>
            <p>El Nivel Educativo <strong>' . $nivel->nombre . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('nivel.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel = Nivel::find($id);

        if (!$nivel || $nivel->estado == 0) {
            abort(404);
        }

        return view('nivel.show')->with('nivel', $nivel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nivel = Nivel::find($id);

        if (!$nivel || $nivel->estado == 0) {
            abort(404);
        }

        $materias = Materia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        $mis_materias = $nivel->materias->pluck('id')->toArray();

        return view('nivel.edit')
            ->with('nivel', $nivel)
            ->with('materias', $materias)
            ->with('mis_materias', $mis_materias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NivelRequest $request, $id)
    {
         $nivel = nivel::find($id);

        if (!$nivel || $nivel->estado == 0) {
            abort(404);
        }
        
        $nivel->fill($request->all());

        if ($request->orientador_materia == 1) {
            $nivel->orientador_materia = 1;
        } else {
            $nivel->orientador_materia = 0;
        }
        
        $nivel->save();

        // Almacenamiento de materias impartidas en el nivel educativo.
        $nivel->materias()->sync($request->materias);

        flash('
            <h4>Edición de Nivel</h4>
            <p>Nivel Educativo <strong>' . $nivel->nombre . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('nivel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel =nivel::find($id);

        if (!$nivel || $nivel->estado == 0) {
            abort(404);
        }

        $nivel->estado = 0;

        $nivel->save();

        flash('
            <h4>Baja de Nivel Academico</h4>
            <p>El Nivel Educativo <strong>' . $nivel->user_id . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('nivel.index');
    }


    public function pdf()
    {        

        $niveles = Nivel::all(); 

        $pdf = PDF::loadView('nivel.pdf', compact('niveles'));

        return $pdf->download('niveles.pdf');
    }
}
