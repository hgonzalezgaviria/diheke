<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    //
    protected $table = "reservas";
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
