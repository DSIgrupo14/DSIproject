<?php

namespace DSIproject\Http\Controllers;

use Illuminate\Http\Request;
use DSIproject\Anio;
use Laracasts\Flash\Flash;

class AnioController extends Controller
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

            $anios = Anio::where('estado', 1)
                ->where('numero', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('activo', 'like', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->paginate(25);
        }

        return view('anios.index')
            ->with('anios', $anios)
            ->with('searchText', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anio = new Anio($request->all());
        $anio->estado = 1;

        $anio->save();

        flash('
            <h4>Registro de Año Escolar</h4>
            <p>El año Escolar <strong>' . $anio->numero . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('anios.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
