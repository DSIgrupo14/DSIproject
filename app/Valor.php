<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'valores';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'valor',
    	'estado',
    ];

    /**
     * Obtiene los alumnos a los que se les ha evaluado el valor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alumnos()
    {
        return $this->belongsToMany('DSIproject\Alumno', 'alumno_valor')
            ->withPivot(['grado_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Obtiene los grados en los que se evalua el valor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados()
    {
        return $this->belongsToMany('DSIproject\Grado', 'alumno_valor')
            ->withPivot(['alumno_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }
}
