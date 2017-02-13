<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    //

    protected $table = 'EQUIPOS';
    protected $primaryKey = 'EQUI_ID';
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'EQUI_FECHACREADO';
	const UPDATED_AT = 'EQUI_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'EQUI_FECHAELIMINADO';
	protected $dates = ['EQUI_FECHAELIMINADO'];
	
	protected $fillable = [
		'EQUI_DESCRIPCION',
		'EQUI_OBSERVACIONES',
		'SALA_ID',
		'ESTA_ID',
		'EQUI_CREADOPOR'
	];

    protected $hidden = [
      	"EQUI_ID"
    ];

    //Una Equipo se encuentra en una Sala
	public function sala()
	{
		$foreingKey = 'SALA_ID';
		return $this->belongsTo(Sala::class, $foreingKey);
	}

    //Una Equipo tiene muchas reservas
	public function reservas()
	{
		$foreingKey = 'SALA_ID';
		return $this->hasMany(Reservas::class, $foreingKey);
	}

	//Un Equipo tiene un Estado
	public function estado()
	{
		$foreingKey = 'ESTA_ID';
		return $this->belongsTo(Estado::class, $foreingKey);
	}


	    //Una Equipo tiene muchos prestamos
	public function prestamo()
	{
		$foreingKey = 'EQUI_ID';
		return $this->hasMany(Prestamo::class, $foreingKey);
	}


}
