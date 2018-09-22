<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'municipios';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'departamento_id',
    	'nombre',
    ];

    /**
     * Obtiene el departamento al que pertenece el municipio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('DSIproject\Departamento');
    }

    /**
     * Obtiene los alumnos que viven en el municipio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alumnos()
    {
        return $this->hasMany('DSIproject\Alumno');
    }
}
