<?php

namespace DSIproject\Http\Controllers;

use Carbon\Carbon;
use DB;
use DSIproject\Alumno;
use DSIproject\Grado;
use DSIproject\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
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

            // Lista de grados para select de búsqueda.
            $grados = DB::table('grados')
                ->join('anios', 'grados.anio_id', 'anios.id')
                ->select('grados.*')
                ->where('grados.estado', 1)
                ->where('anios.estado', 1)
                ->pluck('grados.codigo', 'grados.id');

            // En caso de estar vacío el select de grados.
            $grado = "";

            if ($request->get('searchGrado') == null) {

                // Cuando no se ha seleccionado ningún grado.
                $matriculas = DB::table('matriculas')
                    ->join('alumnos', 'matriculas.alumno_id', 'alumnos.id')
                    ->join('grados', 'matriculas.grado_id', 'grados.id')
                    ->join('anios', 'grados.anio_id', 'anios.id')
                    ->select('matriculas.*', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.nie', 'grados.codigo', 'anios.editable')
                    ->where('anios.estado', 1)
                    ->where('alumnos.nombre', 'like', '%' . $query . '%')
                    ->orWhere('anios.estado', 1)
                    ->where('alumnos.apellido', 'like', '%' . $query . '%')
                    ->orWhere('anios.estado', 1)
                    ->where('alumnos.nie', 'like', '%' . $query . '%')
                    ->orWhere('anios.estado', 1)
                    ->where('alumnos.genero', 'like', '%' . $query . '%')
                    ->orderBy('alumnos.nombre', 'asc')
                    ->paginate(25);
            } else {
                
                // Cuando se ha seleccionado un grado.
                $grado = $request->get('searchGrado');

                $matriculas = DB::table('matriculas')
                    ->join('alumnos', 'matriculas.alumno_id', 'alumnos.id')
                    ->join('grados', 'matriculas.grado_id', 'grados.id')
                    ->join('anios', 'grados.anio_id', 'anios.id')
                    ->select('matriculas.*', 'alumnos.nombre', 'alumnos.apellido', 'alumnos.nie', 'grados.codigo', 'anios.editable')
                    ->where('matriculas.grado_id', $grado)
                    ->where('anios.estado', 1)
                    ->where('alumnos.nombre', 'like', '%' . $query . '%')
                    ->orWhere('matriculas.grado_id', $grado)
                    ->where('anios.estado', 1)
                    ->where('alumnos.apellido', 'like', '%' . $query . '%')
                    ->orWhere('matriculas.grado_id', $grado)
                    ->where('anios.estado', 1)
                    ->where('alumnos.nie', 'like', '%' . $query . '%')
                    ->orWhere('matriculas.grado_id', $grado)
                    ->where('anios.estado', 1)
                    ->where('alumnos.genero', 'like', '%' . $query . '%')
                    ->orderBy('alumnos.nombre', 'asc')
                    ->paginate(25);
            }
        }

        return view('matriculas.index')
            ->with('grados', $grados)
            ->with('matriculas', $matriculas)
            ->with('searchText', $query)
            ->with('grado', $grado);
    }

    /**
     * Muestra el formulario para crear una nueva matrícula.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grados = DB::table('grados')
            ->join('anios', 'grados.anio_id', 'anios.id')
            ->select('grados.*', 'anios.numero', 'anios.activo', 'anios.editable', 'anios.estado as anio_estado')
            ->where('grados.estado', 1)
            ->where('anios.estado', 1)
            ->where('anios.editable', 1)
            ->pluck('grados.codigo', 'grados.id');

        $alumnos = Alumno::orderBy('nombre', 'asc')->get()->pluck('nombre_and_apellido', 'id');

        return view('matriculas.create')
            ->with('grados', $grados)
            ->with('alumnos', $alumnos);
    }

    /**
     * Almacena una matrícula recién creada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación general.
        $this->validate(request(), [
            'alumno_id' => 'required',
            'grado_id'  => 'required',
        ]);

        $matricula = new Matricula($request->all());
        $matricula->desercion = null;

        // Validando que solo haya una matrícula por año para cada alumno.
        $grados = Grado::where('anio_id', $matricula->grado->anio_id)->get();

        foreach ($grados as $grado) {
            $validacion = Matricula::where('alumno_id', $matricula->alumno_id)
                ->where('grado_id', $grado->id)
                ->first();

            if ($validacion) {
                flash('
                    <h4>Error de Matriculación</h4>
                    <p>No se ha registrado la matrícula de <strong>' . $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido . '</strong> porque ya tiene un registro de matriculación en el año <strong>' . $grado->anio->numero . '.</strong></p>
                ')->error()->important();

                return back();
            }
        }

        $matricula->save();

        flash('
            <h4>Registro de Matrícula</h4>
            <p>La matrícula de <strong>' . $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido . '</strong> en el grado <strong>' . $matricula->grado->codigo . '</strong> se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('matriculas.index');
    }

    /**
     * Muestra el formulario para editar la matrícula especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            abort(404);
        } elseif ($matricula->grado->anio->editable == 0) {
            abort(403);
        }

        if ($matricula->desercion == null) {
            $desercion = 0;
        } else {
            $desercion = 1;
        }

        return view('matriculas.edit')
            ->with('matricula', $matricula)
            ->with('desercion', $desercion);
    }

    /**
     * Actualiza la matrícula especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            abort(404);
        } elseif ($matricula->grado->anio->editable == 0) {
            abort(403);
        }
        
        if ($request->desercion == 1) {
            $matricula->desercion = Carbon::parse(Carbon::now())->format('Y-m-d');
        } else {
            $matricula->desercion = null;
        }
        
        $matricula->save();

        flash('
            <h4>Edición de Matrícula</h4>
            <p>La matrícula de <strong>' . $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido . '</strong> en el grado <strong>' . $matricula->grado->codigo . '</strong> se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('matriculas.index');
    }

    /**
     * Elimina a la matrícula especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matricula = Matricula::find($id);

        if (!$matricula) {
            abort(404);
        } elseif ($matricula->grado->anio->editable == 0) {
            abort(403);
        }

        // Eliminando solo matrículas con notas mayores a cero.
        $notas = $matricula->alumno->evaluaciones->where('grado_id', $matricula->grado_id);

        $borrar = true;

        foreach ($notas as $nota) {
            if ($nota->pivot->nota > 0) {
                $borrar = false;
                break;
            }
        }

        if ($borrar) {
            
            // Eliminando todas las notas relacionadas.
            if (count($notas) > 0) {

                foreach ($notas as $nota) {
                    $n = DB::table('alumno_evaluacion')
                        ->where('alumno_id', $nota->pivot->alumno_id)
                        ->where('evaluacion_id', $nota->pivot->evaluacion_id)
                        ->delete();
                }
            }

            $matricula->delete();

            flash('
                <h4>Eliminación de Matrícula</h4>
                <p>La matrícula de <strong>' . $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido . '</strong> en el grado <strong>' . $matricula->grado->codigo . '</strong> se ha eliminado correctamente.</p>
            ')->error()->important();
        } else {
            flash('
                <h4>Eliminación de Matrícula</h4>
                <p>La matrícula de <strong>' . $matricula->alumno->nombre . ' ' . $matricula->alumno->apellido . '</strong> en el grado <strong>' . $matricula->grado->codigo . '</strong> no se puede eliminar porque ya tiene notas mayores a cero registradas.</p>
            ')->warning()->important();
        }


        return redirect()->route('matriculas.index');
    }
}
