<?php

namespace DSIproject\Http\Controllers;

use DB;
use DSIproject\Anio;
use DSIproject\Docente;
use DSIproject\Evaluacion;
use DSIproject\Grado;
use DSIproject\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;

class NotaController extends Controller
{
    /**
     * Muestra una lista de grados y materias impartidas en el año.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obteniendo año del cual se tomaran los registros.
        $anio = Anio::where('activo', 1)->first();

        if ($request->anio_search) {
            $anio = Anio::find($request->anio_search);
        }

        // Para select que contiene los años.
        $anios = Anio::where('estado', 1)
            ->orderBy('numero', 'asc')
            ->pluck('numero', 'id');

        /*
         * Obteniendo grados donde se es orientador y materias que se imparten.
         * Los usuarios con rol de director o secretaria pueden ver todos los registros.
         */
        $materias = Collection::make();

        if (\Auth::user()->docen()) {

            $docente = Docente::where('user_id', \Auth::user()->id)->first();
            
            $grados = Grado::where('estado', 1)
                ->where('anio_id', $anio->id)
                ->where('docente_id', $docente->id)
                ->orderBy('codigo', 'asc')
                ->get();

            foreach ($grados as $grado) {

                $m = DB::table('materias')
                    ->join('grado_materia', 'materias.id', 'grado_materia.materia_id')
                    ->join('grados', 'grado_materia.grado_id', 'grados.id')
                    ->select('materias.*', 'grados.codigo as grado', 'grado_materia.id as gra_mat')
                    ->where('grado_materia.grado_id', $grado->id)
                    ->where('grado_materia.docente_id', $docente->id)
                    ->orderBy('nombre', 'asc')
                    ->get();

                $materias->push($m);
            }
        } else {

            $grados = Grado::where('estado', 1)
                ->where('anio_id', $anio->id)
                ->orderBy('codigo', 'asc')
                ->get();

            foreach ($grados as $grado) {

                $m = DB::table('materias')
                    ->join('grado_materia', 'materias.id', 'grado_materia.materia_id')
                    ->join('grados', 'grado_materia.grado_id', 'grados.id')
                    ->select('materias.*', 'grados.codigo as grado', 'grado_materia.id as gra_mat')
                    ->where('grado_materia.grado_id', $grado->id)
                    ->orderBy('nombre', 'asc')
                    ->get();

                $materias->push($m);
            }
        }

        return view('notas.index')
            ->with('anio', $anio)
            ->with('anios', $anios)
            ->with('grados', $grados)
            ->with('materias', $materias);
    }

    /**
     * Muestra el cuadro de notas para edición.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $gra_mat = DB::table('grado_materia')
            ->select('grado_id', 'materia_id')
            ->where('id', $id)
            ->first();

        if (!$gra_mat) {
            abort(404);
        }

        $grado = Grado::find($gra_mat->grado_id);

        $materia = Materia::find($gra_mat->materia_id);

        // Si campo trimestre es nulo.
        if (!$request->trimestre) {
            $request->trimestre = 1;
        }

        $evaluaciones = Evaluacion::where('grado_id', $grado->id)
            ->where('materia_id', $materia->id)
            ->where('trimestre', $request->trimestre)
            ->orderBy('posicion', 'asc')
            ->get();

        return view('notas.edit')
            ->with('grado', $grado)
            ->with('materia', $materia)
            ->with('gra_mat', $id)
            ->with('evaluaciones', $evaluaciones);
    }
}
