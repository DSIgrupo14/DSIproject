<?php

namespace DSIproject\Http\Controllers;

use DSIproject\Materia;
use DSIproject\Http\Requests\MateriaRequest;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MateriaController extends Controller
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

            $materias = Materia::where('estado', 1)
                ->where('codigo', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('materias.index')
            ->with('materias', $materias)
            ->with('searchText', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriaRequest $request)
    {
        $materia = new Materia($request->all());
        $materia->estado = 1;

        $materia->save();

        flash('
            <h4>Registro de Materia</h4>
            <p>La materia <strong>' . $materia->nombre . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('materias.index');
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
        $materia = Materia::find($id);

        if (!$materia || $materia->estado == 0) {
            abort(404);
        }

        return view('materias.edit')->with('materia', $materia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MateriaRequest $request, $id)
    {
        $materia = Materia::find($id);

        if (!$materia || $materia->estado == 0) {
            abort(404);
        }
        
        $materia->fill($request->all());
        
        $materia->save();

        flash('
            <h4>Edición de Materia</h4>
            <p>La materia <strong>' . $materia->id . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('materias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = Materia::find($id);

        if (!$materia || $materia->estado == 0) {
            abort(404);
        }

        $materia->estado = 0;

        $materia->save();

        flash('
            <h4>Baja de Materia</h4>
            <p>La materia <strong>' . $materia->nombre . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('materias.index');
    }


  public function pdf(Request $request)
    {
         if ($request) {
            $query = trim($request->get('searchText'));

            $materias = Materia::where('estado', 1)
                ->where('codigo', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('materias.pdf')
            ->with('materias', $materias)
            ->with('searchText', $query);
    }
}
