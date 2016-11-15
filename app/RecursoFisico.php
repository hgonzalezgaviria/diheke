<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecursoFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'RECURSOFISICO';
    protected $primaryKey = 'REFI_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'REFI_FECHACREADO';
	const UPDATED_AT = 'REFI_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'REFI_FECHAELIMINADO';
	protected $dates = ['REFI_FECHAELIMINADO'];
	
	protected $fillable = [
		'REFI_NOMENCLATURA',
		'REFI_CAPACIDADMAXIMA',
		'REFI_TIPOASIGNACION',
		'REFI_DESCRIPCION',
		'REFI_NIVEL',
		'REFI_ESTADO',
		'REFI_CAPACIDADREAL',
		'REFI_PRESTABLE',
		'REFI_AREAREAL',
		'REFI_AREAUSADA',
	];

    protected $hidden = [
      	"REFI_ID"
    ];

	//Un RecursoFisico tiene un EspacioFisico
	public function espacioFisico()
	{
		$foreingKey = 'ESFI_ID';
		return $this->belongsTo(EspacioFisico::class, $foreingKey);
	}
	
	//Un RecursoFisico tiene un TipoPosesion
	public function tipoPosesion()
	{
		$foreingKey = 'TIPO_ID';
		return $this->belongsTo(TipoPosesion::class, $foreingKey);
	}

	//Un RecursoFisico tiene una SituacionRecursoFisico
	public function situacionRecursoFisico()
	{
		$foreingKey = 'SIRF_ID';
		return $this->belongsTo(SituacionRecursoFisico::class, $foreingKey);
	}

	//Un RecursoFisico tiene un TipoRecursoFisico
	public function tipoRecursoFisico()
	{
		$foreingKey = 'TIRF_ID';
		return $this->belongsTo(TipoRecursoFisico::class, $foreingKey);
	}

}
