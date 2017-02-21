<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class PersonaNaturalGeneral extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'PERSONANATURALGENERAL';
    protected $primaryKey = 'PEGE_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PENG_fechacreado';
	const UPDATED_AT = 'PENG_fechamodificado';
					
	protected $fillable = [
		'PEGE_ID',
		'PENG_PRIMERAPELLIDO',
		'PENG_SEGUNDOAPELLIDO',
		'PENG_PRIMERNOMBRE',
		'PENG_SEGUNDONOMBRE',
		'PENG_SEXO',
	];

	public function personaGeneral()
	{
		$foreingKey = 'PEGE_ID';
		return $this->belongsTo(PersonaGeneral::class, $foreingKey);
	}
}
