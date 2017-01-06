<?php

namespace reservas;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

	//Nombre de la tabla en la base de datos
	protected $table = 'USERS';
    protected $primaryKey = 'USER_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'USER_FECHACREADO';
	const UPDATED_AT = 'USER_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'USER_FECHAELIMINADO';
	protected $dates = ['USER_FECHAELIMINADO'];


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'username', 'email', 'password', 'ROLE_ID', 'USER_CREADOPOR'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function rol()
	{
		$foreingKey = 'ROLE_ID';
		return $this->belongsTo(Rol::class, $foreingKey);
	}
}
