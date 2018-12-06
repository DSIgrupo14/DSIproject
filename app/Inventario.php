<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
    	'fecha',
      ];

    /**
     * Obtiene los inventario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recursos()
    {
        return $this->belongsToMany('DSIproject\Recurso', 'inventario_recurso')
            ->withPivot('recurso_id')
            ->withTimestamps();
    }
}
