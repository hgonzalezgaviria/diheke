<?php

namespace reservas;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

	//Nombre de la tabla en la base de datos
	protected $table = 'users';
    protected $primaryKey = 'id';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'USER_fechacreado';
	const UPDATED_AT = 'USER_fechamodificado';
	use SoftDeletes;
	const DELETED_AT = 'USER_fechaeliminado';
	protected $dates = ['USER_fechaeliminado'];


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'username', 'email', 'password', 'role', 'USER_creadopor'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
}
