<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'jornadas';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'docente_id',
    	'fecha',
    	'hora_entrada',
    	'hora_salida',
    ];

    /**
     * Obtiene al docente ralacionado a la jornada.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function docente()
    {
        return $this->belongsTo('DSIproject\Docente');
    }
}
