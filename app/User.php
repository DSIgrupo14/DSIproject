<?php

namespace DSIproject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
        'rol_id',
        'nombre',
        'apellido',
        'email',
        'password',
        'dui',
        'imagen',
        'estado',
    ];

    /**
     * Atributos que deben estar ocultos para los arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtiene el rol que posee el usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo('DSIproject\Rol');
    }

    /**
     * Obtiene los docentes que tienen asignado el usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docentes()
    {
        return $this->hasMany('DSIproject\Docente');
    }
}
