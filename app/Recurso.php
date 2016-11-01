<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{

	protected $fillable = [
	'descripcion', 'version', 'observaciones'
	];

}
