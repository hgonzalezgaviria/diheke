<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    //

    protected $table = 'EQUIPOS';
    protected $primaryKey = 'EQUI_ID';
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'EQUI_FECHACREADO';
	const UPDATED_AT = 'EQUI_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'EQUI_FECHAELIMINADO';
	protected $dates = ['EQUI_FECHAELIMINADO'];
	
	protected $fillable = [
		'EQUI_DESCRIPCION',
		'EQUI_OBSERVACIONES',
		'SALA_ID',
		'ESTA_ID',
		'EQUI_CREADOPOR'
	];

    protected $hidden = [
      	"EQUI_ID"
    ];

    //Una Sala se encuentra en una Sede
	public function sala()
	{
		$foreingKey = 'SALA_ID';
		return $this->belongsTo(Sala::class, $foreingKey);
	}

	//Un Equipo tiene un estado
	public function estado()
	{
		$foreingKey = 'ESTA_ID';
		return $this->belongsTo(Estado::class, $foreingKey);
	}

}
