<?php

namespace DSIproject\Http\Controllers;

use DB;
use DSIproject\Docente;
use DSIproject\Evaluacion;
use DSIproject\Grado;
use DSIproject\Http\Requests\EvaluacionRequest;
use DSIproject\Materia;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva evaluación.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $gra_mat = DB::table('grado_materia')
            ->select('grado_id', 'materia_id', 'docente_id')
            ->where('id', $id)
            ->first();

        if (!$gra_mat) {
            abort(404);
        }

        if (\Auth::user()->docen()) {

            $docente = Docente::where('user_id', \Auth::user()->id)->first();

            // Verificando si el docente imparte esta materia.
            if ($gra_mat->docente_id != $docente->id) {
                abort(403);
            }
        }

        $grado = Grado::find($gra_mat->grado_id);
        $grados = Grado::orderBy('codigo', 'asc')->pluck('codigo', 'id');

        $materia = Materia::find($gra_mat->materia_id);
        $materias = Materia::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('evaluaciones.create')
            ->with('grado', $grado)
            ->with('grados', $grados)
            ->with('materia', $materia)
            ->with('materias', $materias)
            ->with('gra_mat', $id);
    }

    /**
     * Almacena una evaluación recién creada en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\EvaluacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvaluacionRequest $request)
    {
        $evaluacion = new Evaluacion($request->all());

        // Obteniendo porcentaje como flotante.
        $evaluacion->porcentaje = round($request->porcentaje) / 100;

        // Validando que el porcentaje de evaluaciones no supere el 100%.
        if ($this->validarCienPorCiento($evaluacion)) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>Se supera el 100% de porcentaje de evaluaciones para esta materia en este trimestre.</p>
            ')->error()->important();

            return back();
         }

        // Validando porcentaje de la evaluación.
        if ($evaluacion->tipo == 'EXA') {
            if ($this->validarExamen($evaluacion)) {
                flash('
                    <h4>Examen</h4>
                    <p>Solo puede haber una evaluación de examen del 30% en una materia cada trimestre.</p>
                ')->error()->important();

                return back();
            }
        } else {
            if ($this->validarActividad($evaluacion->porcentaje)) {
                flash('
                    <h4>Actividad</h4>
                    <p>Una actividad debe tener un porcentaje de 35% o menos.</p>
                ')->error()->important();

                return back();
            }
        }

        // Obteniendo posición a asignar a la evaluación.
        $numero_posiciones = Evaluacion::where('tipo', 'ACT')
            ->where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->orWhere('tipo', 'EXA')
            ->where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->count();

        $evaluacion->posicion = $numero_posiciones + 1;

        $evaluacion->save();

        flash('
            <h4>Registro de Evaluación</h4>
            <p>La evaluación se ha registrado correctamente.</p>
        ')->success()->important();

        return redirect()->route('notas.edit', $request->gra_mat);
    }

    /**
     * Muestra el formulario para editar la evaluación especificada.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evaluacion = Evaluacion::find($id);

        if (!$evaluacion) {
            abort(404);
        }

        $gra_mat = DB::table('grado_materia')
            ->where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->first();

        return view('evaluaciones.edit')
            ->with('evaluacion', $evaluacion)
            ->with('gra_mat', $gra_mat->id);
    }

    /**
     * Actualiza la evaluación especificada en la base de datos.
     *
     * @param  \DSIproject\Http\Requests\EvaluacionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EvaluacionRequest $request, $id)
    {
        $evaluacion = Evaluacion::find($id);

        $porcentaje_original = $evaluacion->porcentaje * 100;

        if (!$evaluacion) {
            abort(404);
        }
        
        $evaluacion->fill($request->all());

        // Obteniendo porcentaje como flotante.
        $evaluacion->porcentaje = round($request->porcentaje) / 100;

        // Validando que el porcentaje de evaluaciones no supere el 100%.
        if ($this->validarCienPorCiento($evaluacion)) {
            flash('
                <h4>Error en Ingreso de Datos</h4>
                <p>Se supera el 100% de porcentaje de evaluaciones para esta materia en este trimestre.</p>
            ')->error()->important();

            return back();
         }

        // Validando porcentaje de la evaluación.
        if ($evaluacion->tipo == 'EXA') {
            if ($this->validarExamen($evaluacion)) {
                flash('
                    <h4>Examen</h4>
                    <p>Solo puede haber una evaluación de examen del 30% en una materia cada trimestre.</p>
                ')->error()->important();

                return back();
            }
        } else {
            if ($this->validarActividad($evaluacion->porcentaje)) {
                flash('
                    <h4>Actividad</h4>
                    <p>Una actividad debe tener un porcentaje de 35% o menos.</p>
                ')->error()->important();

                return back();
            }
        }

        $evaluacion->save();

        flash('
            <h4>Edición de Evaluación</h4>
            <p>La evaluación se ha editado correctamente.</p>
        ')->success()->important();

        return redirect()->route('notas.edit', $request->gra_mat);
    }

    /**
     * Elimina a la evaluación especificada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $evaluacion = Evaluacion::find($id);

        if (!$evaluacion) {
            abort(404);
        }

        // Reordenando evaluaciones.
        $evaluaciones = Evaluacion::where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->where('posicion', '>', $evaluacion->posicion)
            ->orderBy('posicion', 'asc')
            ->get();

        if (count($evaluaciones) > 0) {

            foreach ($evaluaciones as $eva) {
                $eva->posicion -= 1;
                $eva->save();
            }
        }

        // Eliminando todas las notas relacionadas.
        $notas = DB::table('alumno_evaluacion')
            ->where('evaluacion_id', $evaluacion->id)
            ->get();

        if (count($notas) > 0) {

            foreach ($notas as $nota) {

                $evaluacion = Evaluacion::find($nota->evaluacion_id);
                
                $evaluacion->alumnos()->detach($nota->alumno_id);
            }
        }

        $evaluacion->delete();

        flash('
            <h4>Eliminación de Evaluación</h4>
            <p>La evaluación se ha eliminado correctamente.</p>
        ')->error()->important();

        return redirect()->route('notas.edit', $request->gra_mat);
    }

   /**
     * Permite que la evaluación suba en su posición.
     *
     * @param  int  $gra_mat_id
     * @param  int  $evaluacion_id
     * @return \Illuminate\Http\Response
     */
    public function subir($gra_mat_id, $evaluacion_id)
    {
        $evaluacion = Evaluacion::find($evaluacion_id);

        $gra_mat = DB::table('grado_materia')
            ->where('id', $gra_mat_id)
            ->first();

        if (!$evaluacion || !$gra_mat) {
            abort(404);
        }

        // Validando que la evaluación no tenga la posición 1.
        if ($evaluacion->posicion <= 1) {
            flash('
                <h4>Error al Subir Posición</h4>
                <p>No es posible subir más posiciones a esta evaluación.</p>
            ')->error()->important();

            return back();
        }

        $evaluacion_arriba = Evaluacion::where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->where('posicion', $evaluacion->posicion - 1)
            ->first();

        // Subiendo posición de la evaluación.
        $evaluacion->posicion -= 1;
        $evaluacion->save();

        // Bajando posición de la evaluación que estaba antes arriba.
        $evaluacion_arriba->posicion += 1;
        $evaluacion_arriba->save();

        return redirect()->route('notas.edit', $gra_mat_id);
    }

    /**
     * Permite que la evaluación baje en su posición.
     *
     * @param  int  $gra_mat_id
     * @param  int  $evaluacion_id
     * @return \Illuminate\Http\Response
     */
    public function bajar($gra_mat_id, $evaluacion_id)
    {
        $evaluacion = Evaluacion::find($evaluacion_id);

        $gra_mat = DB::table('grado_materia')
            ->where('id', $gra_mat_id)
            ->first();

        if (!$evaluacion || !$gra_mat) {
            abort(404);
        }

        // Validando que la evaluación no tenga la última posición.
        $ultima_posicion = Evaluacion::where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->count();

        if ($evaluacion->posicion >= $ultima_posicion) {
            flash('
                <h4>Error al Bajar Posición</h4>
                <p>No es posible bajar más posiciones a esta evaluación.</p>
            ')->error()->important();

            return back();
        }

        $evaluacion_abajo = Evaluacion::where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->where('posicion', $evaluacion->posicion + 1)
            ->first();

        // Bajando posición de la evaluación.
        $evaluacion->posicion += 1;
        $evaluacion->save();

        // Subiendo posición de la evaluación que estaba antes abajo.
        $evaluacion_abajo->posicion -= 1;
        $evaluacion_abajo->save();

        return redirect()->route('notas.edit', $gra_mat_id);
    }

    /**
     * Verifica que el porcentaje de evaluaciones no supere el 100%.
     *
     * @param  \DSIproject\Evaluacion  $evaluacion
     * @return bool
     */
    public function validarCienPorCiento($evaluacion)
    {
        $respuesta = false;

        $evaluaciones = Evaluacion::where('tipo', 'ACT')
            ->where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->orWhere('tipo', 'EXA')
            ->where('grado_id', $evaluacion->grado_id)
            ->where('materia_id', $evaluacion->materia_id)
            ->where('trimestre', $evaluacion->trimestre)
            ->get();

        $porcentaje_total = 0.001; // Por problemas con la presición.

        foreach ($evaluaciones as $eva) {
            $porcentaje_total += $eva->porcentaje;
        }

        // Comprobando si la evaluación existe para el formulario de edición.
        if ($evaluacion->id) {
            $porcentaje_total -= $evaluacion->porcentaje;
        }

        if ($porcentaje_total >= 1) {
            // Ya se completó el 100%.
            $respuesta = true;
        }

        return $respuesta;
    }

    /**
     * Verifica que en el trimestre solo haya un examen y valga 30%.
     *
     * @param  \DSIproject\Evaluacion  $evaluacion
     * @return bool
     */
    public function validarExamen($evaluacion)
    {
        $respuesta = false;

        if (! $evaluacion->id) {
            $examen = Evaluacion::where('grado_id', $evaluacion->grado_id)
                ->where('materia_id', $evaluacion->materia_id)
                ->where('trimestre', $evaluacion->trimestre)
                ->where('tipo', 'EXA')
                ->get();
        } else {
            $examen = [];
        }

        if (count($examen) > 0 || $evaluacion->porcentaje != 0.3) {
            // Ya existe un examen en el trimestre o el porcentaje es incorrecto.
            $respuesta = true;
        }

        return $respuesta;
    }

    /**
     * Verifica que el porcentaje de una actividad sea menor o igual a 35%.
     *
     * @param  float  $porcentaje
     * @return bool
     */
    public function validarActividad($porcentaje)
    {
        $respuesta = false;

        if ($porcentaje > 0.35) {
            // El porcentaje es incorrecto.
            $respuesta = true;
        }

        return $respuesta;
    }
}
