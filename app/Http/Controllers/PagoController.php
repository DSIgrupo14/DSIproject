<?php

namespace DSIproject\Http\Controllers;

use DB;
use DSIproject\Alumno;
use DSIproject\Anio;
use DSIproject\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Muestra una lista de pagos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $pagos = Pago::where('estado', 1)
                ->where('anio_id', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('mes', 'like', '%' . $query . '%')
                ->orderBy('anio_id', 'desc')
                ->paginate(25);
        }

        foreach ($pagos as $pago) {
            $pago = $this->pasarMes($pago);
        }

        return view('pagos.index')
            ->with('pagos', $pagos)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo pago.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anios = Anio::orderBy('numero', 'desc')->pluck('numero', 'id');

        return view('pagos.create')
            ->with('anios', $anios);
    }

    /**
     * Almacena un pago recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación general.
        $this->validate(request(), [
            'anio_id' => 'required',
            'mes'     => 'required',
        ]);

        $pago = new pago($request->all());
        $pago->estado = 1;

        // Validando registro único.
        $pago_validar = Pago::where('anio_id', $pago->anio_id)
            ->where('mes', $pago->mes)
            ->first();

        if ($pago_validar != null) {
            flash('
                <h4>Error en ingreso de datos</h4>
                <p>Ya existe un pago de alimentos para este año y mes.</p>
            ')->error()->important();

            return back();
        }

        $pago->save();

        flash('
            <h4>Registro de pago</h4>
            <p>El pago se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('pagos.index');
    }

    /**
     * Almacena un pago recién creado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store2(Request $request, $id)
    {
        // Validación general.
        $this->validate(request(), [
            'alumno_id' => 'required',
            'pago'      => 'required|numeric',
        ]);

        $pago = Pago::find($id);

        if (!$pago || $pago->estado == 0) {
            abort(404);
        }

        // Validando registro único.
        $pago_validar = DB::table('alumno_pago')
            ->where('alumno_id', $request->alumno_id)
            ->where('pago_id', $pago->id)
            ->first();

        if ($pago_validar != null) {
            flash('
                <h4>Error en ingreso de datos</h4>
                <p>Ya existe un pago de alimentos realizado por este estudiante.</p>
            ')->error()->important();

            return back();
        }

        $pago->alumnos()->attach($request->alumno_id, ['pago' => $request->pago]);

        flash('
            <h4>Registro de pago</h4>
            <p>El pago se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->back();
    }

    /**
     * Muestra una lista de alumnos que han realizado el pago.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $pago = Pago::find($id);

        if (!$pago || $pago->estado == 0) {
            abort(404);
        }

        $pago = $this->pasarMes($pago);

        $alumnos = Alumno::orderBy('nombre', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        // Lista de alumnos que han realizado el pago.
        if ($request) {
            $query = trim($request->get('searchText'));

            $pagos = DB::table('alumno_pago as ap')
                ->join('alumnos as a', 'ap.alumno_id', 'a.id')
                ->join('pagos as p', 'ap.pago_id', 'p.id')
                ->join('anios as an', 'p.anio_id', 'an.id')
                ->select('ap.*', 'a.nombre', 'a.apellido')
                ->where('ap.pago_id', $pago->id)
                ->where('a.nombre', 'like', '%' . $query . '%')
                ->orWhere('ap.pago_id', $pago->id)
                ->where('a.apellido', 'like', '%' . $query . '%')
                ->orderBy('a.nombre', 'asc')
                ->paginate(25);
        }

        return view('pagos.show')
            ->with('pago', $pago)
            ->with('pagos', $pagos)
            ->with('searchText', $query)
            ->with('alumnos', $alumnos);
    }

    /**
     * Muestra el formulario para editar el pago especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pago = Pago::find($id);

        if (!$pago || $pago->estado == 0) {
            abort(404);
        }

        $anios = Anio::orderBy('numero', 'desc')->pluck('numero', 'id');

        return view('pagos.edit')
            ->with('pago', $pago)
            ->with('anios', $anios);
    }

    /**
     * Actualiza el pago especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación general.
        $this->validate(request(), [
            'anio_id' => 'required',
            'mes'     => 'required',
        ]);

        $pago = Pago::find($id);

        if (!$pago || $pago->estado == 0) {
            abort(404);
        }
        
        $pago->fill($request->all());

        // Validando registro único.
        $pago_validar = Pago::where('anio_id', $pago->anio_id)
            ->where('mes', $pago->mes)
            ->where('id', '!=', $pago->id)
            ->first();

        if ($pago_validar != null) {
            flash('
                <h4>Error en ingreso de datos</h4>
                <p>Ya existe un pago de alimentos para este año y mes.</p>
            ')->error()->important();

            return back();
        }
        
        $pago->save();

        flash('
            <h4>Edición de Pago</h4>
            <p>El pago se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('pagos.index');
    }

    /**
     * Da de baja al pago especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pago = Pago::find($id);

        if (!$pago || $pago->estado == 0) {
            abort(404);
        }

        $pago->estado = 0;

        $pago->save();

        flash('
            <h4>Baja de Pago</h4>
            <p>El pago se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('pagos.index');
    }

    /**
     * Da de baja al pago especificado de un alumno.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy2($id)
    {
        $alumno_pago = DB::table('alumno_pago')->find($id);

        if (!$alumno_pago) {
            abort(404);
        }

        DB::table('alumno_pago')->delete($id);

        flash('
            <h4>Eliminación de Pago</h4>
            <p>El pago se ha eliminado correctamente.</p>
        ')->error()->important();

        return back();
    }

    /**
     * Pasa el número del mes a su nombre correspondiente.
     *
     * @param  DSIproject\Pago  $id
     * @return array
     */
    public function pasarMes($pago)
    {
        switch ($pago->mes) {
            case 1:
                $pago->mes = 'Enero';
                break;
            case 2:
                $pago->mes = 'Febrero';
                break;
            case 3:
                $pago->mes = 'Marzo';
                break;
            case 4:
                $pago->mes = 'Abril';
                break;
            case 5:
                $pago->mes = 'Mayo';
                break;
            case 6:
                $pago->mes = 'Junio';
                break;
            case 7:
                $pago->mes = 'Julio';
                break;
            case 8:
                $pago->mes = 'Agosto';
                break;
            case 9:
                $pago->mes = 'Septiembre';
                break;
            case 10:
                $pago->mes = 'Octubre';
                break;
            case 11:
                $pago->mes = 'Noviembre';
                break;
            case 12:
                $pago->mes = 'Diciembre';
                break;
        }

        return $pago;
    }
}
