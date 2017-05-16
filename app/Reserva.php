<?php

namespace reservas;

use reservas\ModelWithSoftDeletes;

class Reserva extends ModelWithSoftDeletes
{
    //Nombre de la tabla en la base de datos
    protected $table = "RESERVAS";
    protected $primaryKey = 'RESE_ID';

    //Traza: Nombre de campos en la tabla para auditoría de cambios
    const CREATED_AT = 'RESE_FECHACREADO';
    const UPDATED_AT = 'RESE_FECHAMODIFICADO';
    const DELETED_AT = 'RESE_FECHAELIMINADO';
    protected $dates = ['RESE_FECHAELIMINADO'];


    protected $fillable = [
        "RESE_TITULO",
        "RESE_FECHAINI",
        "RESE_TODOELDIA",
        "RESE_COLOR",
        "RESE_FECHAFIN",
        'SALA_ID',
        'EQUI_ID',
    ];


    //Constantes para colores asignados al estado de la reserva
    const COLOR_PENDIENTE  = 'rgb(255, 255, 0)'; //Yellow
    const COLOR_APROBADO   =  'rgb(0, 255, 0)';  //Lime
    const COLOR_RECHAZADO  = 'rgb(255, 0, 0)';   //Red
    const COLOR_ANULADO  = 'rgb(255, 0, 0)';   //Red
    const COLOR_FINALIZADO  = 'rgb(204, 204, 204)'; //Gray 80%

    //Una Reserva se asocia a una sala
    public function sala()
    {
        $foreingKey = 'SALA_ID';
        return $this->belongsTo(Sala::class, $foreingKey);
    }
    
    //Una Reserva puede tener asociado un equipo
    public function equipo()
    {
        $foreingKey = 'EQUI_ID';
        return $this->belongsTo(Equipo::class, $foreingKey);
    }


    /*
     * Las reservas que están autorizadas.
     * en el constructor, para relacionar una reserva usar:
     * $reserva->autorizacion()->sync([x, y , z], false); //Sin el false, reemplaza las relaciones existentes.
     */
    public function autorizaciones()
    {
        $foreingKey = 'RESE_ID';
        $otherKey   = 'AUTO_ID';
        return $this->belongsToMany(Autorizacion::class, 'RESERVAS_AUTORIZADAS', $foreingKey,  $otherKey);
    }


    //Scope Join con Autorizaciones
    public function scopeAutorizaciones($query)
    {
        $query = $query->join('RESERVAS_AUTORIZADAS',
                            'RESERVAS_AUTORIZADAS.RESE_ID', '=', 'RESERVAS.RESE_ID')
                        ->join('AUTORIZACIONES',
                            'AUTORIZACIONES.AUTO_ID', '=', 'RESERVAS_AUTORIZADAS.AUTO_ID');
        return $query;
    }
    //Scope Reservas aprobadas
    public function scopeAprobadas($query)
    {
        return $query->autorizaciones()
                    ->where('AUTORIZACIONES.ESTA_ID', Estado::RESERVA_APROBADA);
    }
    //Scope Reservas pendientes por aprobar
    public function scopePendientesAprobar($query)
    {
        return $query->autorizaciones()
                    ->where('AUTORIZACIONES.ESTA_ID', Estado::RESERVA_PENDIENTE);
    }
    //Scope Reservas pendientes por aprobar
    public function scopeProgramadas($query)
    {
        return $query->autorizaciones()
                    ->where('AUTORIZACIONES.ESTA_ID', '!=', Estado::RESERVA_RECHAZADA)
                    ->where('AUTORIZACIONES.ESTA_ID', '!=', Estado::RESERVA_ANULADA);
    }

    //Scope Reservas todas
    public function scopeTodas($query)
    {
        return $query->autorizaciones()
                    ->orWhere('AUTORIZACIONES.ESTA_ID', '=', Estado::RESERVA_RECHAZADA)
                    ->orWhere('AUTORIZACIONES.ESTA_ID', '=', Estado::RESERVA_ANULADA)
                    ->orWhere('AUTORIZACIONES.ESTA_ID', '=', Estado::RESERVA_PENDIENTE)
                    ->orWhere('AUTORIZACIONES.ESTA_ID', '=', Estado::RESERVA_APROBADA);
    }
}
