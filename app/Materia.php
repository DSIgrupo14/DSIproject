<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'materias';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo',
    	'nombre',
    	'estado',
    ];

    /**
     * Obtiene los niveles educativos donde se imparte la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function niveles()
    {
        return $this->belongsToMany('DSIproject\Nivel')->withTimestamps();
    }
}
