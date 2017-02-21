<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'MATERIAS';
    protected $primaryKey = 'MATE_CODIGOMATERIA';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'MATE_fechacreado';
	const UPDATED_AT = 'MATE_fechamodificado';

	protected $fillable = [
		'MATE_CODIGOMATERIA',
		'MATE_NOMBRE',
		'UNID_ID',
	];

	public function unidad()
	{
		$foreingKey = 'UNID_ID';
		return $this->belongsTo(Unidad::class, $foreingKey);
	}
}
