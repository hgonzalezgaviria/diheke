<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{

	//Nombre de la tabla en la base de datos
	protected $table = 'PRESTAMOS';
    protected $primaryKey = 'PRES_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PRES_FECHACREADO';
	const UPDATED_AT = 'PRES_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'PRES_FECHAELIMINADO';
	protected $dates = ['PRES_FECHAELIMINADO'];

	protected $fillable = [
		'PRES_IDUSARIO', 
		'PRES_NOMBREUSARIO', 
		'EQUI_ID',		
		'PRES_CREADOPOR',
		'PRES_FECHAINI',
		'PRES_FECHAFIN',
			];



	//Un prestamo tiene un equipo
	public function equipo()
	{		
		$foreingKey = 'EQUI_ID';
		return $this->belongsTo(Equipo::class, $foreingKey);


	
	
}
}
