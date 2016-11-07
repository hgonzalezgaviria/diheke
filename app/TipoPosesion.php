<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPosesion extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'TIPOPOSESION';
    protected $primaryKey = 'TIPO_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TIPO_FECHACREADO';
	const UPDATED_AT = 'TIPO_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'TIPO_FECHAELIMINADO';
	protected $dates = ['TIPO_FECHAELIMINADO'];
	
	protected $fillable = [
		'TIPO_DESCRIPCION', 'TIPO_CENTRODEPRACTICA', 'TIPO_CREADOPOR', 'TIPO_MODIFICADOPOR'
	];

	//Un TipoPosesion tiene muchas Localidades
	public function localidades()
	{
		$foreingKey = 'TIPO_ID';
		return $this->hasMany(Localidad::class, $foreingKey);
	}
}
