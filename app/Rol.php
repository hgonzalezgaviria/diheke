<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'ROLES';
    protected $primaryKey = 'ROLE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ROLE_FECHACREADO';
	const UPDATED_AT = 'ROLE_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'ROLE_FECHAELIMINADO';
	protected $dates = ['ROLE_FECHAELIMINADO'];

	protected $fillable = ['ROLE_ROL','ROLE_DESCRIPCION','ROLE_CREADOPOR'];


	//Constantes para referenciar los roles creados por SYSTEM
	const ADMIN      = 1;
	const EDITOR     = 2;
	const ESTUDIANTE = 3;
	const DOCENTE    = 4;
	const USER       = 5;
	
	//public static $ENCU_estados = Config::get('enums.estados_encuesta');

	public function usuarios()
	{
		$foreingKey = 'ROLE_ID';
		return $this->hasMany(User::class, $foreingKey);
	}



}
