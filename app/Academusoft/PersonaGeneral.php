<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class PersonaGeneral extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'PERSONAGENERAL';
    protected $primaryKey = 'PEGE_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'PEGE_fechacreado';
	const UPDATED_AT = 'PEGE_fechamodificado';
	
	protected $fillable = [
		'PEGE_ID',
		'PEGE_DOCUMENTOIDENTIDAD',
	];

	public function personaNaturalGeneral()
	{
		$foreingKey = 'PEGE_ID';
		return $this->belongsTo(PersonaNaturalGeneral::class, $foreingKey);
	}
}
