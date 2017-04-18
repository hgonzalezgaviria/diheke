@extends('layout')
@section('title', '/ Validador de Reservas')
@section('scripts')
    <script>

    	$(function () {

    		/*
    		archivo validador de reservas utilizado para probar metodos para controlar que no se
    		realicen reservas traslapadas con otras fechas en cada uno de los días, por todas las
    		reservas existentes (es decir que un día puede tener una o muchas reservas agendadas)
    		y para almacenar una nueva reserva esta debe ser comparada contra todas las existentes
    		del día.

    		variables:

    		finireservaexis: es la variable que contiene la fecha inicial de una reserva existente de prueba
    		ffinreservaexis: es la variable que contiene la fecha final de una reserva existente de prueba

    		finireservanew: es la variable que contiene la fecha inicial de una nueva reserva de prueba
    		ffinreservanew: es la variable que contiene la fecha final de una nueva reserva de prueba

    		funciones:

    		validarReserva: funcion que recibe cuatro parametros (4 fechas moment) en el orden de
	    		1- fecha inicial de la reserva existente
	    		2- fecha final de la reserva existente
	    		3- fecha inicial de la nueva reserva
	    		4- fecha final de la nueva reserva

	    	la funcion realiza las siguientes validaciones:
				
				1- que la fecha de inicio de la nueva reserva sea mayor o igual que la fecha de inicio de la reserva existente Y que la fecha de inicio de la nueva reserva sea mayor o igual que la fecha final de la reserva existente Y que la fecha final de la nueva reserva sea mayor o igual que la fecha final de la reserva existente

				2- que la fecha de inicio de la nueva reserva sea menor o igual que la fecha de inicio de la reserva existente Y que la fecha de inicio de la nueva reserva sea menor o igual que la fecha final de la reserva existente Y que la fecha final de la nueva reserva sea menor o igual que la fecha final de la reserva existente

			Nota: los metodos son incluyentes en sus limites, es decir que si una reserva finaliza a las 16:00 una nueva reserva puede iniciar a la misma hora. Ejemplo:

				Reserva A (existente): fecha de inicio 	2017-04-15 16:00
						   			   fecha final 		2017-04-15 17:00


				Reserva B (nueva): 	   fecha de inicio 	2017-04-15 17:00
						   			   fecha final 		2017-04-15 19:00

				Conclusión: la nueva reserva (B) es valida para agendarse


			Retorno de la función: retorna una variable de tipo boolean y el valor esta determinado por la validación sobre la nueva reserva que se desea agendar

				1- retorna TRUE cuando la reserva se puede agendar de acuerdo a la validación realizada
				2- retorna FALSE cuando la reserva no se puede agendar de acuerdo a la validación realizada


			Modo de uso: para probar solo se deben cambiar los valores de las variables y recargar la pagina
			"testreserva"

    		*/

    		//fechas supuestas de reserva existente
    		var finireservaexis, ffinreservaexis;

    		//fechas supuestas de nueva reserva
    		var finireservanew, ffinreservanew;

    		//valores de fechas supuestas de reserva existente
    		finireservaexis = "2017-04-11 16:00";
    		ffinreservaexis = "2017-04-11 18:00";

    		//valores de fechas supuestas de nueva reserva
    		finireservanew = "2017-04-11 18:00";
    		ffinreservanew = "2017-04-11 20:00";


    		//conversión de fechas supuestas de reservas existentes con moment
    		finireservaexis = moment(finireservaexis, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
    		ffinreservaexis = moment(ffinreservaexis, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

    		//conversión de fechas de nuevas reservas con moment
    		finireservanew = moment(finireservanew, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');
    		ffinreservanew = moment(ffinreservanew, 'YYYY-MM-DD HH:mm').format('YYYY-MM-DD HH:mm');

    		
    		function validarReserva(finireservaexis, ffinreservaexis, finireservanew, ffinreservanew){

    			var esvalida = false;

    			if( ((finireservanew >= finireservaexis) && (finireservanew >= ffinreservaexis)) && (ffinreservanew >= ffinreservaexis) ){
    				esvalida = true;

    				console.log("la fecha de inicio de la reserva: "+ finireservanew + " es mayor o igual a la fecha de inicio de la reserva existente: "+ finireservaexis + "\n" + " la fecha de inicio de la reserva: " + finireservanew + " es mayor o igual a la fecha final de la reserva existente: " + ffinreservaexis + "\n" + " Y la fecha final de la nueva reserva: "+ffinreservanew + " es mayor o igual a la fecha final de reserva existente: "+ ffinreservaexis);
    			}
    			else if( ((finireservanew < finireservaexis) && (finireservanew < ffinreservaexis)) && (ffinreservanew <= finireservaexis) ){
    				esvalida = true;

    				console.log("la fecha de inicio de la reserva: "+ finireservanew + " es menor a la fecha de inicio de la reserva existente: "+ finireservaexis + "\n" + " la fecha de inicio de la reserva: " + finireservanew + " es menor a la fecha final de la reserva existente: " + ffinreservaexis + "\n" + " Y la fecha final de la nueva reserva: "+ffinreservanew + " es menor o igual a la fecha inicial de reserva existente: "+ finireservaexis);
    			}
    			else{
    				esvalida = false;
    			}

    			return esvalida;

    		}

    		//variable que guarda el boolean retornado por la funcion para validar la reserva
    		//true = la reserva es valida, false = la reserva no es valida ya que se traslapa
    		var correcta = validarReserva(finireservaexis, ffinreservaexis, finireservanew, ffinreservanew);

    		//imprime el resultado en pantalla
    		alert("la reserva es: " + correcta);

    	});


    </script>
@endsection

@section('content')

	<h1 class="page-header">Validar Reserva JS</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'festivos', 'class' => 'form-vertical')) }}

		{{ Form::label('FEST_FECHA', 'Modifique las variables en el archivo JS y recargue esta pagina') }} 

		
		{{ Form::close() }}
@endsection
