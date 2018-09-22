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

    /**
     * Obtiene las evaluaciones de la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluaciones()
    {
        return $this->hasMany('DSIproject\Evaluacion');
    }

    /**
     * Obtiene los grados donde se imparte la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados()
    {
        return $this->belongsToMany('DSIproject\Grado', 'grado_materia')
            ->withPivot('docente_id')
            ->withTimestamps();
    }

    /**
     * Obtiene los docentes que imparten la materia.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function docentes()
    {
        return $this->belongsToMany('DSIproject\Docente', 'grado_materia')
            ->withPivot('grado_id')
            ->withTimestamps();
    }
}
