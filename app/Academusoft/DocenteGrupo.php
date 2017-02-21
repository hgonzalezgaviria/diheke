<?php

namespace reservas\Academusoft;

use Illuminate\Database\Eloquent\Model;

class DocenteGrupo extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'DOCENTESGRUPOS';
    protected $primaryKey = 'DOUN_ID';
	
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'DOGR_fechacreado';
	const UPDATED_AT = 'DOGR_fechamodificado';

	protected $fillable = [
		'DOUN_ID',
		'GRUP_ID',
	];

	public function grupo()
	{
		$foreingKey = 'GRUP_ID';
		return $this->belongsTo(Grupo::class, $foreingKey);
	}

	public function docenteUnidad()
	{
		$foreingKey = 'DOUN_ID';
		return $this->belongsTo(DocenteUnidad::class, $foreingKey);
	}
}
