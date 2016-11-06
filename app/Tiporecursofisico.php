<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Tiporecursofisico extends Model
{
    //
    protected $table = 'tiporecursofisico';

    protected $fillable = [
		'TIRF_DESCRIPCION'
	];

}
