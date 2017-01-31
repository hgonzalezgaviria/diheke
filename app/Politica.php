<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Politica extends Model
{
    //
    //Nombre de la tabla en la base de datos
	protected $table = 'POLITICAS';
    protected $primaryKey = 'POLI_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'POLI_FECHACREADO';
	const UPDATED_AT = 'POLI_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'POLI_FECHAELIMINADO';
	protected $dates = ['POLI_FECHAELIMINADO'];
	

	protected $fillable = [
		'POLI_DESCRIPCION',
		'POLI_HORA_MIN',
		'POLI_HORA_MAX',
		'POLI_HORAS_MIN_RESERVA',
		'POLI_DIAS_MIN_CANCELAR'
	];
	
}
