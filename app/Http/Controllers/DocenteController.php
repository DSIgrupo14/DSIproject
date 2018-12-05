<?php

namespace DSIproject\Http\Controllers;

use DSIproject\Docente;
use DSIproject\Jornadas;
use DSIproject\Grados;
use DSIproject\User;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\Facade as PDF;

class DocenteController extends Controller
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

            $docentes = Docente::where('estado', 1)
                ->where('user_id', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('docente.index')
            ->with('docentes', $docentes)
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
        $users = User::orderBy('apellido', 'asc')->pluck('apellido', 'id');
        return view('docente.create')->with('users', $users);
    }

    /**
     * Almacena un docente en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docente = new Docente($request->all());
        $docente->estado = 1;

        $docente->save();

        flash('
            <h4>Registro de Docente</h4>
            <p>El Docente <strong>' . $docente->nombre . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('docentes.index');
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
        $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
            abort(404);
        }

        $users = User::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('docente.edit')
            ->with('docente', $docente)
            ->with('users', $users);
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
         $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
            abort(404);
        }
        
        $docente->fill($request->all());
        
        $docente->save();

        flash('
            <h4>Edición de Docente</h4>
            <p>El docente <strong>' . $docente->id . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('docentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $docente = Docente::find($id);

        if (!$docente || $docente->estado == 0) {
            abort(404);
        }

        $docente->estado = 0;

        $docente->save();

        flash('
            <h4>Baja de Docente</h4>
            <p>El Docente <strong>' . $docente->user_id . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('docentes.index');
    }

    public function pdf(Request $request)
    {        
        if ($request) {
            $query = trim($request->get('searchText'));

            $docentes = Docente::where('estado', 1)
                ->where('user_id', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('docente.pdf')
            ->with('docentes', $docentes)
            ->with('searchText', $query);
    }
}
