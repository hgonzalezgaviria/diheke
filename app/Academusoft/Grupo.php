<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'GRUPOS';
    protected $primaryKey = 'GRUP_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'GRUP_fechacreado';
	const UPDATED_AT = 'GRUP_fechamodificado';

	protected $fillable = [
		'GRUP_ID',
		'GRUP_NOMBRE',
		'GRUP_FECHAINICIAL',
		'GRUP_FECHAFINAL',
		'GRUP_ACTIVO',
		'GRUP_CAPACIDAD',
		'MATE_CODIGOMATERIA',
	];

	public function Materia()
	{
		$foreingKey = 'MATE_CODIGOMATERIA';
		return $this->belongsTo(Unidad::class, $foreingKey);
	}
}
