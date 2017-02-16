<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Festivo;

use Session;
use Illuminate\Support\Facades\Input;
use DB;

class FestivosController extends Controller
{
    //

    public function getFestivos()
    {
        //Se obtienen todas los festivos.
        //$festivos = Festivo::all();

        $festivos = Festivo::orderBy('FEST_FECHA', 'desc')->get();
        
        return json_encode($festivos);
    }

}
