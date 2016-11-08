<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Localidad extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'LOCALIDAD';
    protected $primaryKey = 'LOCA_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'LOCA_FECHACREADO';
	const UPDATED_AT = 'LOCA_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'LOCA_FECHAELIMINADO';
	protected $dates = ['LOCA_FECHAELIMINADO'];
	
	protected $fillable = [
		'LOCA_DESCRIPCION', 'LOCA_AREA', 'LOCA_CREADOPOR', 'LOCA_MODIFICADOPOR'
	];

	//Una Localidad tiene un TipoPosesion
	public function tipoPosesion()
	{
		$foreingKey = 'TIPO_ID';
		return $this->belongsTo(TipoPosesion::class, $foreingKey);
	}

	//Una Localidad tiene muchos EspacioFisico
	public function localidades()
	{
		$foreingKey = 'LOCA_ID';
		return $this->hasMany(EspacioFisico::class, $foreingKey);
	}
	
}
