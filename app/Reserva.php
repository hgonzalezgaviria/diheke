<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserva extends Model
{
    //Nombre de la tabla en la base de datos
    protected $table = "RESERVAS";
    protected $primaryKey = 'RESE_ID';

    //Traza: Nombre de campos en la tabla para auditoría de cambios
    const CREATED_AT = 'RESE_FECHACREADO';
    const UPDATED_AT = 'RESE_FECHAMODIFICADO';
    use SoftDeletes;
    const DELETED_AT = 'RESE_FECHAELIMINADO';
    protected $dates = ['RESE_FECHAELIMINADO'];



    protected $fillable = [
        "RESE_FECHAINI",
        "RESE_FECHAFIN",
        "RESE_TODOELDIA",
        "RESE_COLOR",
        "RESE_TITULO",
        'SALA_ID',
    ];

    protected $hidden = [
      	"RESE_ID"
    ];
}
