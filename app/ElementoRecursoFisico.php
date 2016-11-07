<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElementoRecursoFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'ELEMENTOSRECURSOFISICO';
    protected $primaryKey = 'ELRF_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ELRF_FECHACREADO';
	const UPDATED_AT = 'ELRF_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'ELRF_FECHAELIMINADO';
	protected $dates = ['ELRF_FECHAELIMINADO'];
	
	protected $fillable = [
		'ELRF_DESCRIPCION', 'ELRF_CREADOPOR', 'ELRF_MODIFICADOPOR'
	];

	//Un ElementoRecursoFisico pertenece a un EstadoElementoRecursoFisico
	public function estadoElementoRecursoFisico()
	{
		$foreingKey = 'EERF_ID';
		return $this->belongsTo(EstadoElementoRecursoFisico::class, $foreingKey);
	}
	
}
