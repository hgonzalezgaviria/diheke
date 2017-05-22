<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Festivo extends Model
{
    //
    protected $table = 'FESTIVOS';
    protected $primaryKey = 'FEST_ID';
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'FEST_FECHACREADO';
	const UPDATED_AT = 'FEST_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'FEST_FECHAELIMINADO';
	protected $dates = ['FEST_FECHAELIMINADO'];
	
	protected $fillable = [
		'FEST_FECHA',
		'FEST_DESCRIPCION',
		'FEST_CREADOPOR',
	];

    protected $hidden = [
      	"FEST_ID"
    ];

}
