<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'pagos';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'anio_id',
    	'mes',
    	'estado',
    ];

    /**
     * Obtiene el año al que pertenece el pago.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anio()
    {
        return $this->belongsTo('DSIproject\Anio');
    }

    /**
     * Obtiene los alumnos a los que se les ha registrado el pago.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alumnos()
    {
        return $this->belongsToMany('DSIproject\Alumno', 'alumno_pago')
            ->withPivot('pago')
            ->withTimestamps();
    }
}
