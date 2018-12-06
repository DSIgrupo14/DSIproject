<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'recursos';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'nombre',
    	'descripcion',
    ];

    /**
     * Obtiene los inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inventarios()
    {
        return $this->belongsToMany('DSIproject\Inventario', 'inventario_recurso')
            ->withPivot('invetario_id')
            ->withTimestamps();
    }

}
