<?php

namespace DSIproject\Http\Controllers;

use Illuminate\Http\Request;
use DSIproject\Docente;
use DSIproject\Jornada;
use DSIproject\User;
use Laracasts\Flash\Flash;


class JornadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $jornadas = Jornada::orderBy('id','ASC')->paginate(25);

        return view('jornadas.index')
            ->with('jornadas', $jornadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docente::orderBy('user_id', 'asc')->pluck('user_id', 'id');
        return view('jornadas.create')->with('docentes', $docentes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jornada = new Jornada($request->all());

        $jornada->save();

        flash('
            <h4>Registro de Jornada Laboral</h4>
            <p>La jornada laboral con fecha <strong>' . $jornada->fecha. '</strong> se registro correctamente.</p>
        ')->success()->important();

        return redirect()->route('jornadas.index');
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
