<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class DocenteUnidad extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'DOCENTESUNIDADES';
    protected $primaryKey = 'DOUN_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'DOUN_fechacreado';
	const UPDATED_AT = 'DOUN_fechamodificado';

	protected $fillable = [
		'DOUN_ID',
		'PEGE_ID',
		'UNID_ID',
	];

	public function personaGeneral()
	{
		$foreingKey = 'PEGE_ID';
		return $this->belongsTo(PersonaGeneral::class, $foreingKey);
	}
	
	public function unidad()
	{
		$foreingKey = 'UNID_ID';
		return $this->belongsTo(Unidad::class, $foreingKey);
	}
}
