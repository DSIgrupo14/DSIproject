<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'matriculas';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'alumno_id',
    	'grado_id',
    	'desercion',
    ];

    /**
     * Obtiene el alumno ralacionado a la matricula.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alumno()
    {
        return $this->belongsTo('DSIproject\Alumno');
    }

    /**
     * Obtiene el grado ralacionado a la matricula.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grado()
    {
        return $this->belongsTo('DSIproject\Grado');
    }

    /**
     * Obtiene el apellido del alumno.
     *
     * @return string
     */
    public function getApellidoAttribute()
    {
        return $this->alumno->apellido;
    }    
}
