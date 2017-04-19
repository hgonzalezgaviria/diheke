<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{

	//Nombre de la tabla en la base de datos
	protected $table = 'ESTADOS';
    protected $primaryKey = 'ESTA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ESTA_FECHACREADO';
	const UPDATED_AT = 'ESTA_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'ESTA_FECHAELIMINADO';
	protected $dates = ['ESTA_FECHAELIMINADO'];

	const SALA_DISPONIBLE   = 1;
	const SALA_OCUPADA      = 2;

	const EQUIPO_DISPONIBLE = 3;
	const EQUIPO_OCUPADO    = 4;

	const RESERVA_PENDIENTE = 5;
	const RESERVA_APROBADA  = 6;
	const RESERVA_RECHAZADA = 7;
	const RESERVA_ANULADA   = 8;

	protected $fillable = [
		'ESTA_DESCRIPCION', 
		'TIES_ID',
		'ESTA_CREADOPOR',
	];

	//Un estado tiene muchas Salas
	public function salas()
	{
		$foreingKey = 'ESTA_ID';
		return $this->hasMany(Sala::class, $foreingKey);
	}

	//Un estado tiene muchas equipos
	public function equipos()
	{
		$foreingKey = 'ESTA_ID';
		return $this->hasMany(Equipo::class, $foreingKey);
	}

	//Un estado tiene muchas equipos
	public function autorizaciones()
	{
		$foreingKey = 'ESTA_ID';
		return $this->hasMany(Autorizacion::class, $foreingKey);
	}

	//Un estado tiene tipo estado
	public function tipoEstado()
	{
		$foreingKey = 'TIES_ID';
		return $this->belongsTo(TipoEstado::class, $foreingKey);
	}
	
	
}
