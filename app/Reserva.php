<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $table = "RESERVAS";
    protected $fillable = [
    	"fechaini",
    	"fechafin",
    	"todoeldia",
    	"color",
    	"titulo"
    ];

    protected $hidden = [
      	"id"
    ];
}
