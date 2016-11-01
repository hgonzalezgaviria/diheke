<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Tipoestado extends Model
{

	protected $fillable = [
		'descripcion', 'observaciones'
	];

}
