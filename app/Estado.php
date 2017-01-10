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
	
}
