<?php

namespace DSIproject\Http\Controllers;

use Illuminate\Http\Request;
use DSIproject\Recurso;
use Laracasts\Flash\Flash;

class RecursoController extends Controller
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

            $recursos = Recurso::where('nombre', 'like', '%' . $query . '%')
                ->paginate(25);
        }

        return view('recursos.index')
            ->with('recursos', $recursos)
            ->with('searchText', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('recursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recurso = new Recurso($request->all());

        $recurso->save();

        flash('
            <h4>Registro de Recurso</h4>
            <p>El recurso <strong>' . $recurso->nombre . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('recursos.index');
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
        $recurso = Recurso::find($id);

        return view('recursos.edit')
            ->with('recurso', $recurso);
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
        $recurso = Recurso::find($id);
        
        $recurso->fill($request->all());
        
        $recurso->save();

        flash('
            <h4>Edición de Recurso</h4>
            <p>El recurso <strong>' . $recurso->nombre . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('recursos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recurso = Recurso::find($id);

        if (!$recurso) {
            abort(404);
        }

        $recurso->delete();

        flash('
            <h4>Eliminación de Recurso</h4>
            <p>El registro del recurso <strong>' . $recurso->nombre . '</strong> se ha eliminado correctamente.</p>
        ')->error()->important();

        return redirect()->route('recursos.index');
    }
}
