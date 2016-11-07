<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoElementoRecursoFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'ESTADOELEMENTORECURSOFISICO';
    protected $primaryKey = 'EERF_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'EERF_FECHACREADO';
	const UPDATED_AT = 'EERF_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'EERF_FECHAELIMINADO';
	protected $dates = ['EERF_FECHAELIMINADO'];
	
	protected $fillable = [
		'EERF_DESCRIPCION', 'EERF_CREADOPOR', 'EERF_MODIFICADOPOR'
	];

	//Un EstadoElementoRecursoFisico tiene muchos ElementoRecursoFisico
	public function elementosRecursosFisicos()
	{
		$foreingKey = 'EERF_ID';
		return $this->hasMany(ElementoRecursoFisico::class, $foreingKey);
	}
}
