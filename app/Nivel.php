<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'niveles';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'codigo',
    	'nombre',
    	'orientador_materia',
    	'estado',
    ];

    /**
     * Obtiene los grados relacionados al nivel educativo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grados()
    {
        return $this->hasMany('DSIproject\Grado');
    }

    /**
     * Obtiene las materias que imparte el nivel educativo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materias()
    {
        return $this->belongsToMany('DSIproject\Materia')->withTimestamps();
    }
}
