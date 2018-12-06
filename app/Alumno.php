<?php

namespace DSIproject;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /**
     * Nombre de la tabla relacionada a este modelo.
     *
     * @var string
     */
    protected $table = 'alumnos';

    /**
     * Atributos que son asignados en masa.
     *
     * @var array
     */
    protected $fillable = [
    	'municipio_id',
    	'nie',
    	'nombre',
    	'apellido',
    	'fecha_nacimiento',
    	'genero',
    	'direccion',
    	'telefono',
    	'responsable',
    	'estado',
    ];

    /**
     * Obtiene el municipio ralacionado al alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo('DSIproject\Municipio');
    }

    /**
     * Obtiene las matriculas del alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matriculas()
    {
        return $this->hasMany('DSIproject\Matricula');
    }

    /**
     * Obtiene las evaluaciones que ha realizado el alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function evaluaciones()
    {
        return $this->belongsToMany('DSIproject\Evaluacion', 'alumno_evaluacion')
            ->withPivot('nota')
            ->withTimestamps();
    }

    /**
     * Obtiene los valores en que ha sido evaluado el alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function valores()
    {
        return $this->belongsToMany('DSIproject\Valor', 'alumno_valor')
            ->withPivot(['grado_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Obtiene los grados en los que han evaluado valores al alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grados()
    {
        return $this->belongsToMany('DSIproject\Grado', 'alumno_valor')
            ->withPivot(['valor_id', 'trimestre', 'nota'])
            ->withTimestamps();
    }

    /**
     * Obtiene el nombre y apellido del alumno.
     *
     * @return string
     */
    public function getNombreAndApellidoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }

    /**
     * Obtiene los pagos que se han registrado del alumno.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pagos()
    {
        return $this->belongsToMany('DSIproject\Pago', 'alumno_pago')
            ->withPivot('pago')
            ->withTimestamps();
    }
}
