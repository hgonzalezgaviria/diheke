<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{

	protected $fillable = [
	'cedula', 'nombres', 'apellidos', 'nro_contrato', 'estado_contrato', 'fecha_ingreso',
	'fecha_retiro', 'salario', 'tipo_nomina', 'centro_costo'
	];

}
