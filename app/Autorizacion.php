<?php

namespace reservas;

use reservas\ModelWithSoftDeletes;

class Autorizacion extends ModelWithSoftDeletes
{
    protected $table = 'AUTORIZACIONES';
    protected $primaryKey = 'AUTO_ID';
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'AUTO_FECHACREADO';
	const UPDATED_AT = 'AUTO_FECHAMODIFICADO';
	const DELETED_AT = 'AUTO_FECHAELIMINADO';
	protected $dates = ['AUTO_FECHAELIMINADO'];
	
	protected $fillable = [
		'AUTO_FECHASOLICITUD',
		'AUTO_FECHAAPROBACION',
		'ESTA_ID',
		'UNID_ID',
		'PEGE_ID',
		'GRUP_ID',
		'MATE_CODIGOMATERIA',
	];

    protected $hidden = [
      	"AUTO_ID"
    ];

	/*
	 * Las reservas que están autorizadas.
	 */
	public function reservas()
	{
		$foreingKey = 'AUTO_ID';
		$otherKey   = 'RESE_ID';
		return $this->belongsToMany(Reserva::class, 'RESERVAS_AUTORIZADAS', $foreingKey,  $otherKey);
	}

	//Una autorización tiene un Estado
	public function estado()
	{
		$foreingKey = 'ESTA_ID';
		return $this->belongsTo(Estado::class, $foreingKey);
	}

	//Una autorización tiene una materia
	public function materia()
	{
		$foreingKey = 'MATE_CODIGOMATERIA';
		return $this->belongsTo(Materia::class, $foreingKey);
	}



    //Scope Reservas aprobadas
    public function scopeAprobadas($query)
    {
        return $query->where('ESTA_ID', Estado::RESERVA_APROBADA);
    }
    //Scope Reservas pendientes por aprobar
    public function scopePendientesAprobar($query)
    {
        return $query->where('ESTA_ID', Estado::RESERVA_PENDIENTE);
    }
}
