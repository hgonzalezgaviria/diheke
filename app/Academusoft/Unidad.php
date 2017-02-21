<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'UNIDADES';
    protected $primaryKey = 'UNID_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'UNID_fechacreado';
	const UPDATED_AT = 'UNID_fechamodificado';

	protected $fillable = [
		'UNID_ID',
		'UNID_NOMBRE',
		'UNID_CODIGO',
	];

	public function materias()
	{
		$foreingKey = 'UNID_ID';
		return $this->hasMany(Materia::class, $foreingKey);
	}

}
