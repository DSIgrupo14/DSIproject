<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'roles';

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
     * Obtiene los usuarios que tienen asignado el rol.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
    	return $this->hasMany('DSIproject\User');
    }
}
