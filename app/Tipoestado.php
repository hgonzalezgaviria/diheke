<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoEstado extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'TIPOESTADOS';
    protected $primaryKey = 'TIES_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TIES_FECHACREADO';
	const UPDATED_AT = 'TIES_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'TIES_FECHAELIMINADO';
	protected $dates = ['TIES_FECHAELIMINADO'];

	protected $fillable = [
		'TIES_DESCRIPCION', 
		'TIES_OBSERVACIONES', 
		'TIES_CREADOPOR',
		'TIES_FECHACREADO',
		'TIES_MODIFICADOPOR'
	];

	//Un estado tiene muchas Salas
	public function estados()
	{
		$foreingKey = 'TIES_ID';
		return $this->hasMany(Estado::class, $foreingKey);
	}

}
