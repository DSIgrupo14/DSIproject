<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DB;
use DSIproject\Docente;
use DSIproject\Jornada;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Barryvdh\DomPDF\Facade as PDF;

class JornadaController extends Controller
{
    /**
     * Muestra una lista de las jornadas laborales de una fecha específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $hoy = Carbon::now();
            $hoy = Carbon::parse($hoy)->format('Y-m-d');

            if ($request->get('searchFecha') != null) {

                // Validación de la fecha.
                $fecha = $this->crearFecha($request->get('searchFecha'));

                if ($fecha == null) {
                    $fecha = $hoy;
                }
            } else {
                $fecha = $hoy;
            }

            $jornadas = DB::table('jornadas')
                ->join('docentes', 'jornadas.docente_id', 'docentes.id')
                ->join('users', 'docentes.user_id', 'users.id')
                ->select('jornadas.*', 'users.nombre as nombre', 'users.apellido as apellido', 'users.dui as dui', 'docentes.nip as nip', 'docentes.estado')
                ->where('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('apellido', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('dui', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }
        $fecha = Carbon::parse($fecha)->format('d/m/Y');
        return view('jornadas.index')
            ->with('jornadas', $jornadas)
            ->with('searchText', $query)
            ->with('fecha', $fecha);
    }

    /**
     * Muestra el formulario para crear un nuevo registro de la jornada laboral
     * de un docente.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = DB::table('docentes')
            ->join('users', 'docentes.user_id', 'users.id')
            ->select('users.nombre as nombre', 'users.apellido as apellido', 'docentes.id as id', 'docentes.estado')
            ->where('docentes.estado', 1)
            ->orderBy('nombre', 'asc')
            ->get();

        return view('jornadas.create')->with('docentes', $docentes);
    }

    /**
     * Almacena un registro de la jornada laboral de un docente recién creado en
     * la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación general.
        $this->validate(request(), [
            'docente_id'   => 'required',
            'fecha'        => 'required',
            'hora_entrada' => 'required',
        ]);

        $jornada = new Jornada;

        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        // Validación de la hora de entrada.
        $hora_entrada = $this->crearHora($request->hora_entrada);

        if ($hora_entrada == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la hora de entrada es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        if ($request->hora_salida != null) {

            // Validación de la hora de salida.
            $hora_salida = $this->crearHora($request->hora_salida);

            if ($hora_salida == null) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>El formato de la hora de salida es incorrecto.</p>
                ')->error()->important();

                return back();
            }

            // Validación de que la hora de salida debe ser posterior a la de entrada.
            if ($hora_entrada >= $hora_salida) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>La hora de salida debe ser posterior a la de entrada.</p>
                ')->error()->important();

                return back();
            }
        } else {
            $hora_salida = null;
        }

        $jornada->docente_id = $request->docente_id;
        $jornada->fecha = $fecha;
        $jornada->hora_entrada = $hora_entrada;
        $jornada->hora_salida = $hora_salida;

        // Validando registro único.
        if (!$this->esUnica($jornada)) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>Ya existe un registro de la jornada laboral de <strong>' . $jornada->docente->user->nombre . ' ' . $jornada->docente->user->apellido . '</strong> en esa fecha.</p>
            ')->error()->important();

            return back();
        }

        $jornada->save();
        flash('
            <h4>Registro de Jornada Laboral</h4>
            <p>La jornada laboral del docente <strong>' . $jornada->docente->user->nombre . ' ' . $jornada->docente->user->apellido . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('jornadas.index');
    }

    /**
     * Muestra la jornada laboral especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jornada = Jornada::find($id);

        if (!$jornada) {
            abort(404);
        }
        return view('jornadas.show')->with('jornada', $jornada);
    }

    /**
     * Muestra el formulario para editar la jornada laboral especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jornada = Jornada::find($id);

        if (!$jornada) {
            abort(404);
        }
        return view('jornadas.edit')->with('jornada', $jornada);
    }

    /**
     * Actualiza la jornada laboral especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jornada = Jornada::find($id);

        if (!$jornada) {
            abort(404);
        }

        // Validación general.
        $this->validate(request(), [
            'hora_entrada' => 'required',
        ]);

        // Validación de la hora de entrada.
        $hora_entrada = $this->crearHora($request->hora_entrada);

        if ($hora_entrada == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la hora de entrada es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        if ($request->hora_salida != null) {

            // Validación de la hora de salida.
            $hora_salida = $this->crearHora($request->hora_salida);

            if ($hora_salida == null) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>El formato de la hora de salida es incorrecto.</p>
                ')->error()->important();

                return back();
            }

            // Validación de que la hora de salida debe ser posterior a la de entrada.
            if ($hora_entrada >= $hora_salida) {
                flash('
                    <h4>Error en Ingreso de Datos</h4>
                    <p>La hora de salida debe ser posterior a la de entrada.</p>
                ')->error()->important();

                return back();
            }
        } else {
            $hora_salida = null;
        }

        $jornada->hora_entrada = $hora_entrada;
        $jornada->hora_salida = $hora_salida;
        $jornada->save();

        flash('
            <h4>Edición de Jornada Laboral</h4>
            <p>La jornada laboral del docente <strong>' . $jornada->docente->user->nombre . ' ' . $jornada->docente->user->apellido . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('jornadas.index');
    }

    /**
     * Elimina a la jornada laboral especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jornada = Jornada::find($id);

        if (!$jornada) {
            abort(404);
        }

        $jornada->delete();

        flash('
            <h4>Eliminación de Jornada Laboral</h4>
            <p>El registro de la jornada laboral de <strong>' . $jornada->docente->user->nombre . ' ' . $jornada->docente->user->apellido . '</strong> se ha eliminado correctamente.</p>
        ')->error()->important();

        return redirect()->route('jornadas.index');
    }

    /**
     * Da a la fecha el formato correcto para almacenarla en la base de datos y
     * verifica que sea una fecha valida.
     *
     * @param  string  $valor
     * @return string
     */
    public function crearFecha($valor)
    {
        $f = explode('/', $valor); // 0:día, 1:mes, 2:año

        $date = $f[2] . '-' . $f[1] . '-' . $f[0];

        try {
            $fecha = Carbon::parse($date)->format('Y-m-d');
            return $fecha;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Da la hora el formato correcto para almacenarla en la base de datos y
     * verifica que sea una hora valida.
     *
     * @param  string  $valor
     * @return string
     */
    public function crearHora($valor)
    {
        try {
            $hora = Carbon::parse($valor)->format('H:i:s');
            return $hora;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Verifica que el registro de la jornada laboral sea único para un docente
     * en una fecha específica.
     *
     * @param  \DSIproject\Jornada  $jornada
     * @return bool
     */
    public function esUnica($jornada){
        $registro = Jornada::where('docente_id', $jornada->docente_id)
            ->where('fecha', $jornada->fecha)
            ->first();

        if ($registro == null) {
            return true;
        } else {
            return false;
        }
    }

        public function pdf(Request $request)
    {        
if ($request) {
            $query = trim($request->get('searchText'));

            $hoy = Carbon::now();
            $hoy = Carbon::parse($hoy)->format('Y-m-d');

            if ($request->get('searchFecha') != null) {

                // Validación de la fecha.
                $fecha = $this->crearFecha($request->get('searchFecha'));

                if ($fecha == null) {
                    $fecha = $hoy;
                }
            } else {
                $fecha = $hoy;
            }

            $jornadas = DB::table('jornadas')
                ->join('docentes', 'jornadas.docente_id', 'docentes.id')
                ->join('users', 'docentes.user_id', 'users.id')
                ->select('jornadas.*', 'users.nombre as nombre', 'users.apellido as apellido', 'users.dui as dui', 'docentes.nip as nip', 'docentes.estado')
                ->where('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('apellido', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('dui', 'like', '%' . $query . '%')
                ->orWhere('docentes.estado', 1)
                ->where('fecha', $fecha)
                ->where('nip', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }
        $fecha = Carbon::parse($fecha)->format('d/m/Y');
        return view('jornadas.pdf')
            ->with('jornadas', $jornadas)
            ->with('searchText', $query)
            ->with('fecha', $fecha);
       // $jornadas = Jornada::all(); 

        //$pdf = PDF::loadView('jornadas.pdf', compact('jornadas'));

        //$pdf->download('jornadas.pdf');
    }
}
