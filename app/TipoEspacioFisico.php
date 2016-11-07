<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoEspacioFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'TIPOESPACIOFISICO';
    protected $primaryKey = 'TIEF_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TIEF_FECHACREADO';
	const UPDATED_AT = 'TIEF_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'TIEF_FECHAELIMINADO';
	protected $dates = ['TIEF_FECHAELIMINADO'];
	
	protected $fillable = [
		'TIEF_DESCRIPCION', 'TIEF_CREADOPOR', 'TIEF_MODIFICADOPOR'
	];

	//Un TipoEspacioFisico tiene muchos EspacioFisico
	public function espaciosFisicos()
	{
		$foreingKey = 'TIEF_ID';
		return $this->hasMany(EspacioFisico::class, $foreingKey);
	}
}
