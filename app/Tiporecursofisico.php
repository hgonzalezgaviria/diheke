<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoRecursoFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'ESTADOELEMENTORECURSOFISICO';
    protected $primaryKey = 'TIRF_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'TIRF_FECHACREADO';
	const UPDATED_AT = 'TIRF_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'TIRF_FECHAELIMINADO';
	protected $dates = ['TIRF_FECHAELIMINADO'];
	
	protected $fillable = [
		'TIRF_DESCRIPCION', 'TIRF_CREADOPOR', 'TIRF_MODIFICADOPOR'
	];

	//Un EstadoElementoRecursoFisico tiene muchos ElementoRecursoFisico
	public function elementosRecursosFisicos()
	{
		$foreingKey = 'TIRF_ID';
		return $this->hasMany(ElementoRecursoFisico::class, $foreingKey);
	}
}
