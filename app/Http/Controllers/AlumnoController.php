<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DSIproject\Alumno;
use DSIproject\Departamento;
use DSIproject\Http\Requests\AlumnoRequest;
use DSIproject\Municipio;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AlumnoController extends Controller
{
    /**
     * Muestra una lista de alumnos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));

            $alumnos = Alumno::where('estado', 1)
                ->where('nombre', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('apellido', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('nie', 'like', '%' . $query . '%')
                ->orWhere('estado', 1)
                ->where('genero', 'like', '%' . $query . '%')
                ->orderBy('nombre', 'asc')
                ->paginate(25);
        }

        return view('alumnos.index')
            ->with('alumnos', $alumnos)
            ->with('searchText', $query);
    }

    /**
     * Muestra el formulario para crear un nuevo alumno.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->get();

        return view('alumnos.create')
            ->with('departamentos', $departamentos)
            ->with('municipios', $municipios);
    }

    /**
     * Almacena un alumno recién creado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\AlumnoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {        
        $alumno = new Alumno;

        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha_nacimiento);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $alumno->municipio_id = $request->municipio_id;
        $alumno->nie = $request->nie;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->fecha_nacimiento = $fecha;
        $alumno->genero = $request->genero;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->responsable = $request->responsable;
        $alumno->estado = 1;

        $alumno->save();

        flash('
            <h4>Registro de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('alumnos.index');
    }

    /**
     * Muestra el usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        return view('alumnos.show')->with('alumno', $alumno);
    }

    /**
     * Muestra el formulario para editar el alumno especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        $departamentos = Departamento::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $municipios = Municipio::orderBy('nombre', 'asc')->get();

        return view('alumnos.edit')
            ->with('alumno', $alumno)
            ->with('departamentos', $departamentos)
            ->with('municipios', $municipios);
    }

    /**
     * Actualiza el usuario especificado en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\AlumnoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, $id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        // Validación de la fecha.
        $fecha = $this->crearFecha($request->fecha_nacimiento);

        if ($fecha == null) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>El formato de la fecha es incorrecto.</p>
            ')->error()->important();

            return back();
        }

        $alumno->municipio_id = $request->municipio_id;
        $alumno->nie = $request->nie;
        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->fecha_nacimiento = $fecha;
        $alumno->genero = $request->genero;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->responsable = $request->responsable;

        $alumno->save();

        flash('
            <h4>Edición de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('alumnos.index');
    }

    /**
     * Da de baja al usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);

        if (!$alumno || $alumno->estado == 0) {
            abort(404);
        }

        $alumno->estado = 0;

        $alumno->save();

        flash('
            <h4>Baja de Alumno</h4>
            <p>El alumno <strong>' . $alumno->nombre . ' ' . $alumno->apellido . '</strong> se ha dado de baja correctamente.</p>
        ')->error()->important();

        return redirect()->route('alumnos.index');
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
     * Muestra el récord de notas del alumno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function record($id)
    {
        return view('alumnos.record');
    }
}
