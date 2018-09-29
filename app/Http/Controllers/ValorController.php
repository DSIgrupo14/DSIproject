<?php

namespace DSIproject\Http\Controllers;

use Illuminate\Http\Request;
use DSIproject\Valor;
use Laracasts\Flash\Flash;

class ValorController extends Controller
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

            $valores = Valor::where('estado', 1)
                ->where('valor', 'like', '%' . $query . '%')
                ->paginate(25);
        }

        return view('valores.index')
            ->with('valores', $valores)
            ->with('searchText', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('valores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $valor = new Valor($request->all());
        $valor->estado = 1;

        $valor->save();

        flash('
            <h4>Registro de Valor</h4>
            <p>El valor <strong>' . $valor->valor . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('valores.index');
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
        $valor = Valor::find($id);

        if (!$valor || $valor->estado == 0) {
            abort(404);
        }

        return view('valores.edit')
            ->with('valor', $valor);
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
        $valor = Valor::find($id);

        if (!$valor || $valor->estado == 0) {
            abort(404);
        }
        
        $valor->fill($request->all());
        
        $valor->save();

        flash('
            <h4>Edición de Valor</h4>
            <p>El valor <strong>' . $valor->id . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('valores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valor = Valor::find($id);

        if (!$valor || $valor->estado == 0) {
            abort(404);
        }

        $valor->estado = 0;

        $valor->save();

        flash('
            <h4>Baja de Valor</h4>
            <p>El Valor <strong>' . $valor->valor . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('valores.index');
    }
}
