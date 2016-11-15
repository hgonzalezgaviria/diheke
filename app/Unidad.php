<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'UNIDAD';
    protected $primaryKey = 'UNID_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'UNID_FECHACREADO';
	const UPDATED_AT = 'UNID_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'UNID_FECHAELIMINADO';
	protected $dates = ['UNID_FECHAELIMINADO'];
	
	protected $fillable = [
		'UNID_NOMBRE',
		'UNID_CODIGO',
		'UNID_TELEFONO',
		'UNID_EXTTELEFONO',
		'UNID_EMAIL',
		'UNID_UBICACION',
		'UNID_NIVEL',
		'UNID_ASOCIAPROGRAMADIRECTA',
		'UNID_ASOCIAMATERIADIRECTA',
		'UNID_REGIONAL',
	];

	//Una Unidad tiene un TipoUnidad
	public function tipoUnidad()
	{
		$foreingKey = 'TIUN_ID';
		return $this->belongsTo(TipoUnidad::class, $foreingKey);
	}

	
}
