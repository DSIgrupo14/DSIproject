<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'evaluaciones';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'grado_id',
    	'materia_id',
    	'tipo',
    	'porcentaje',
    	'trimestre',
    	'posicion',
    ];

    /**
     * Obtiene el grado al que pertenece la evaluación.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grado()
    {
        return $this->belongsTo('DSIproject\Grado');
    }

    /**
     * Obtiene la materia a la que pertenece la evaluación.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo('DSIproject\Materia');
    }

    /**
     * Obtiene los alumnos que han realizado la evaluación.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alumnos()
    {
        return $this->belongsToMany('DSIproject\Alumno', 'alumno_evaluacion')
            ->withPivot('nota')
            ->withTimestamps();
    }
}
