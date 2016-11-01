<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{

	protected $fillable = [
	'descripcion', 'tipo_estado'
	];

}
