<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'grados';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'nivel_id',
    	'anio_id',
    	'docente_id',
    	'codigo',
    	'seccion',
    	'estado',
    ];

    /**
     * Obtiene el nivel educativo que tiene el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivel()
    {
        return $this->belongsTo('DSIproject\Nivel');
    }

    /**
     * Obtiene el año al que pertenece el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anio()
    {
        return $this->belongsTo('DSIproject\Anio');
    }

    /**
     * Obtiene al docente orientador que tiene el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docente()
    {
        return $this->belongsTo('DSIproject\Docente');
    }

    /**
     * Obtiene las matriculas del grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matriculas()
    {
        return $this->hasMany('DSIproject\Matricula');
    }

    /**
     * Obtiene las evaluaciones del grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluaciones()
    {
        return $this->hasMany('DSIproject\Evaluacion');
    }

    /**
     * Obtiene los docentes que imparten clases de alguna materia en el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function docentes()
    {
        return $this->belongsToMany('DSIproject\Docente', 'grado_materia')
            ->withPivot('materia_id')
            ->withTimestamps();
    }

    /**
     * Obtiene las materias que se imparten en el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materias()
    {
        return $this->belongsToMany('DSIproject\Materia', 'grado_materia')
            ->withPivot('docente_id')
            ->withTimestamps();
    }

    /**
     * Obtiene los valores que se evalúan a los alumnos en el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function valores()
    {
        return $this->belongsToMany('DSIproject\Valor', 'alumno_valor')
            ->withPivot(['alumno_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Obtiene los alumnos a los que se han evaluado valores en el grado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alumnos()
    {
        return $this->belongsToMany('DSIproject\Alumno', 'alumno_valor')
            ->withPivot(['valor_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }
}
