<?php

namespace reservas\Http\Controllers;

use reservas\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sedes = \reservas\EspacioFisico::getEspaciosFisicos();
        $salas = \reservas\RecursoFisico::getRecursosFisicos();
        return view('home', compact('sedes', 'salas'));
    }
}
