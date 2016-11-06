<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SituacionRecursoFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'SITUACIONRECURSOFISICO';
    protected $primaryKey = 'SIRF_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'SIRF_FECHACREADO';
	const UPDATED_AT = 'SIRF_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'SIRF_FECHAELIMINADO';
	protected $dates = ['SIRF_FECHAELIMINADO'];
	
	protected $fillable = [
		'SIRF_DESCRIPCION', 'SIRF_FECHACAMBIO', 'SIRF_REGISTRADOPOR'
	];

}
