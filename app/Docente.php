<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'docentes';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'user_id',
    	'nip',
    	'especialidad',
    	'imagen',
    	'estado',
    ];

    /**
     * Obtiene el usuario ralacionado al docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('DSIproject\User');
    }

    /**
     * Obtiene las jornadas del docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jornadas()
    {
        return $this->hasMany('DSIproject\Jornada');
    }

    /**
     * Obtiene los grados de los cuales es orientador el docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grados()
    {
        return $this->hasMany('DSIproject\Grado');
    }

    /**
     * Obtiene los grados donde imparte clases de alguna materia el docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados2()
    {
        return $this->belongsToMany('DSIproject\Grado', 'grado_materia')
            ->withPivot('materia_id')
            ->withTimestamps();
    }

    /**
     * Obtiene las materias que imparte el docente.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materias()
    {
        return $this->belongsToMany('DSIproject\Materia', 'grado_materia')
            ->withPivot('grado_id')
            ->withTimestamps();
    }

    /**
     * Obtiene el nombre y apellido del docente.
     *
     * @return string
     */
    public function getNombreAndApellidoAttribute()
    {
        return $this->user->nombre . ' ' . $this->user->apellido;
    }
}
