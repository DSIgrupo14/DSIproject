<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'departamentos';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
    ];

    /**
     * Obtiene los municipios que pertenencen al departamento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany('DSIproject\Municipio');
    }
}
