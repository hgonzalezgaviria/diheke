<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUnidad extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'TIPOUNIDAD';
    protected $primaryKey = 'TIUN_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TIUN_FECHACREADO';
	const UPDATED_AT = 'TIUN_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'TIUN_FECHAELIMINADO';
	protected $dates = ['TIUN_FECHAELIMINADO'];
	
	protected $fillable = [
		'TIUN_DESCRIPCION', 'TIUN_CREADOPOR', 'TIUN_MODIFICADOPOR'
	];

	//Un TipoUnidad tiene muchas Unidad
	public function unidades()
	{
		$foreingKey = 'TIUN_ID';
		return $this->hasMany(Unidad::class, $foreingKey);
	}

}
