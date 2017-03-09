<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PDF;


class ExportarPdfController extends Controller {

	protected function getParametros($ENCU_id = null, $docente_id = null)
	{

		$equipos = \reservas\Equipo::all();
		$equiposConPrest = \reservas\Equipo::join('PRESTAMOS', 'PRESTAMOS.EQUI_ID', '=', 'EQUIPOS.EQUI_ID')
                           ->whereDate('PRESTAMOS.PRES_FECHACREADO', '>=', '2017-01-01')
                           ->whereDate('PRESTAMOS.PRES_FECHACREADO', '<=', '2018-02-01')
                           ->groupBy('EQUIPOS.EQUI_ID')
                           ->get();

		$parametros = compact('equipos', 'equiposConPrest');
		return $parametros;
	}



	/**
	 * Carga view 'reportes/layouts.docentes'. Utilizado para pruebas.
	 *
	 * @return Response
	 */
	public function layoutPDF()
	{
		$parametros = $this->getParametros();


		//Se carga la vista y se pasan los registros.
		return view('reportes/layouts/estadisticasEquipos', $parametros);
	}


	/**
	 * Genera PDF con el view 'reportes/layouts.docentes'.
	 *
	 * @return pdf
	 */
	protected function makePDF()
	{
		$parametros = $this->getParametros();

		$pdf = PDF::loadView('reportes/layouts/estadisticasEquipos', $parametros)
					->setPaper('letter', 'landscape');

		$pdf->output();
		$dom_pdf = $pdf->getDomPDF();

		$canvas = $dom_pdf ->get_canvas();
		$canvas->page_text(720, 560, "Pág {PAGE_NUM} de {PAGE_COUNT}", null, 10, [0, 0, 0]);

		$namePDF = 'ARC.pdf';

		return compact('pdf', 'namePDF');
		//return $pdf->stream($namePDF);
		//return $pdf->download('invoice');
	}




	public function streamPDF()
	{
		$pdf = $this->makePDF();
		return $pdf['pdf']->stream($pdf['namePDF']);
	}


	



}