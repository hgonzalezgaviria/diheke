<?php

use Illuminate\Database\Seeder;

class RegFakerTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->command->info('---INICIO RegFakerTableSeeder');

		$faker = Faker\Factory::create('es_ES');
		$username = 'PRUEBA';


		$this->command->info('----Creando RECURSOS');
		$arrRecursos = [];
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\Recurso;
			$model->RECU_DESCRIPCION = 'Recurso '.$i;
			$model->RECU_VERSION = $i;
			$model->RECU_OBSERVACIONES = 'Obs del Recurso '.$i;
			$model->RECU_CREADOPOR = $username;
			$model->save();
			array_push($arrRecursos, $model);
		}




/*
		$this->command->info('----Creando Localidad');
		$arrLocalidad = [];
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\Localidad;
			$model->LOCA_DESCRIPCION = 'Localidad '.$i;
			$model->LOCA_AREA = $i;
			$model->TIPO_ID = $arrTipoPosesion[rand(0,count($arrTipoPosesion)-1)]->TIPO_ID;
			$model->LOCA_CREADOPOR = $username;
			$model->save();
			array_push($arrLocalidad, $model);
		}

		$this->command->info('----Creando EspacioFisico');
		$arrEspacioFisico = [];
		for ($i=1; $i < rand(4,6); $i++) { 
			$model = new reservas\EspacioFisico;
			$model->ESFI_DESCRIPCION = 'EspacioFisico '.$i;
			$model->ESFI_NOMBRE = 'EspacioFisico '.$i;
			$model->ESFI_NRONIVELES = $i;
			$model->ESFI_NOMENCLATURA = 'EspacioFisico '.$i;
			$model->ESFI_AREA = $i;
			$model->TIEF_ID = $arrTipoEspacioFisico[rand(0,count($arrTipoEspacioFisico)-1)]->TIEF_ID;
			$model->TIPO_ID = $arrTipoPosesion[rand(0,count($arrTipoPosesion)-1)]->TIPO_ID;
			$model->LOCA_ID = $arrLocalidad[rand(0,count($arrLocalidad)-1)]->LOCA_ID;
			$model->ESFI_CREADOPOR = $username;
			$model->save();
			array_push($arrEspacioFisico, $model);
		}
		
		$this->command->info('----Creando TipoRecursoFisico');
		$arrTipoRecursoFisicoo = [];
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\TipoRecursoFisico;
			$model->TIRF_DESCRIPCION = 'TipoRecursoFisico '.$i;
			$model->TIRF_CREADOPOR = $username;
			$model->save();
			array_push($arrTipoRecursoFisicoo, $model);
		}
		
		$this->command->info('----Creando TipoUnidad');
		$arrModels = [];
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\TipoUnidad;
			$model->TIUN_DESCRIPCION = 'TipoUnidad '.$i;
			$model->TIUN_CREADOPOR = $username;
			$model->save();
			array_push($arrModels, $model);
		}
		
		$this->command->info('----Creando Unidad');
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\Unidad;
			$model->UNID_NOMBRE = 'Unidad '.$i;
			$model->UNID_CODIGO = 'COD'.$i;
			$model->UNID_TELEFONO = '1';
			$model->UNID_EXTTELEFONO = '1';
			$model->UNID_EMAIL = '1';
			$model->UNID_UBICACION = '1';
			$model->UNID_NIVEL = '1';
			$model->UNID_ASOCIAPROGRAMADIRECTA = '1';
			$model->UNID_ASOCIAMATERIADIRECTA = '1';
			$model->UNID_REGIONAL = '1';
			$model->TIUN_ID = $arrModels[rand(0,count($arrModels)-1)]->TIUN_ID;
			$model->UNID_CREADOPOR = $username;
			$model->save();
		}

		$this->command->info('----Creando EstadoElementoRecursoFisico');
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\EstadoElementoRecursoFisico;
			$model->EERF_DESCRIPCION = 'EstadoElementoRecursoFisico '.$i;
			$model->EERF_CREADOPOR = $username;
			$model->save();
		}


		$this->command->info('----Creando SituacionRecursoFisico');
		$arrSituacionRecursoFisico = [];
		for ($i=1; $i < rand(3,6); $i++) { 
			$model = new reservas\SituacionRecursoFisico;
			$model->SIRF_DESCRIPCION = 'SituacionRecursoFisico '.$i;
			$model->SIRF_CREADOPOR = $username;
			$model->save();
			array_push($arrSituacionRecursoFisico, $model);
		}

		$this->command->info('----Creando RecursoFisico');
		$REFI_TIPOASIGNACION = ['G','C','E'];
		for ($i=1; $i < rand(50,60); $i++) { 
			$model = new reservas\RecursoFisico;

			$model->REFI_NOMENCLATURA = 'RF'.$i;
			$model->REFI_DESCRIPCION = 'RecursoFisico '.$i;
			$model->REFI_TIPOASIGNACION = $REFI_TIPOASIGNACION[rand(0, 2)];
			$model->REFI_ESTADO = 'OK';

			$model->REFI_NIVEL = $i;
			$model->REFI_CAPACIDADMAXIMA = $i;
			$model->REFI_CAPACIDADREAL = $i;
			$model->REFI_AREAREAL = $i;
			$model->REFI_AREAUSADA = $i;
			$model->REFI_PRESTABLE = true;

			$model->ESFI_ID = $arrEspacioFisico[rand(0,count($arrEspacioFisico)-1)]->ESFI_ID;
			$model->TIPO_ID = $arrTipoPosesion[rand(0,count($arrTipoPosesion)-1)]->TIPO_ID;
			$model->SIRF_ID = $arrSituacionRecursoFisico[rand(0,count($arrSituacionRecursoFisico)-1)]->SIRF_ID;
			$model->TIRF_ID = $arrTipoRecursoFisicoo[rand(0,count($arrTipoRecursoFisicoo)-1)]->TIRF_ID;

			$model->REFI_CREADOPOR = $username;
			$model->save();
		}


/*
		$encuesta = new Eva360\Encuesta;
		$encuesta->ENCU_titulo = 'Encuesta de prueba';
		$encuesta->ENCU_descripcion = 'Test de nueva encuesta. Se debe mostrar al inicio del formulario para respuestas.';
        $encuesta->ENCU_plantilla = false;
        $encuesta->ENCU_plantillapublica = false;
		$encuesta->ENCU_fechavigencia = \Carbon\Carbon::now()->addWeeks($faker->randomDigitNotNull)->toDateTimeString();
		$encuesta->ESEN_id = Eva360\EstadoEncuesta::ABIERTA;
		$encuesta->ENCU_creadopor = $username;
		$encuesta->save();


		$this->command->info('----Asignando ROLES a la encuesta');
		$encuesta->dirigidaA()->sync([3,4], false);

		$this->command->info('-----Creando preguntas');

			$this->command->info('------Pregunta abierta');
			$preg = new Eva360\Pregunta;
			$preg->PREG_posicion = $encuesta->preguntas()
											->select('PREG_posicion')
											->groupBy('PREG_posicion')
											->get()
											->max('PREG_posicion') + 1;
			$preg->PREG_texto = 'Formulación de pregunta abierta.';
			$preg->TIPR_id = Eva360\TipoPregunta::where('TIPR_descripcion','Abierta')->get()->first()->TIPR_id;
	        $preg->PREG_creadopor = $username;
			//Se guarda la pregunta en la encuesta (asociación)
			$encuesta->preguntas()->save($preg);

			$this->command->info('--------Respuestas');
			for ($i=0; $i < $cantResp; $i++) { 
				$resp = new Eva360\Respuesta;
				$resp->RESP_valor_int = 0;
				$resp->RESP_valor_str = $faker->sentence();
				$resp->RESP_creadopor = 'RESP'.$i;
					//$resp->ITPR_id = ->ITPR_id;
				$preg->respuestas()->save($resp);
			}

			$this->command->info('------Pregunta SI/NO');
			$preg = new Eva360\Pregunta;
			$preg->PREG_posicion = $encuesta->preguntas()
											->select('PREG_posicion')
											->groupBy('PREG_posicion')
											->get()
											->max('PREG_posicion') + 1;
			$preg->PREG_texto = 'Formulación de pregunta SI/NO.';
			$preg->TIPR_id = Eva360\TipoPregunta::where('TIPR_descripcion','SI/NO')->get()->first()->TIPR_id;
	        $preg->PREG_creadopor = $username;
			//Se guarda la pregunta en la encuesta (asociación)
			$encuesta->preguntas()->save($preg);

			$this->command->info('--------Respuestas');
			for ($i=0; $i < $cantResp; $i++) { 
				$resp = new Eva360\Respuesta;
				$resp->RESP_valor_int = rand(0,1);
				$resp->RESP_valor_str = '';
				$resp->RESP_creadopor = 'RESP'.$i;
					//$resp->ITPR_id = ->ITPR_id;
				$preg->respuestas()->save($resp);
			}




			$this->command->info('------Pregunta Escala (LIKERT)');
			$preg = new Eva360\Pregunta;
			$preg->PREG_posicion = $encuesta->preguntas()
											->select('PREG_posicion')
											->groupBy('PREG_posicion')
											->get()
											->max('PREG_posicion') + 1;
			$preg->PREG_texto = 'Formulación de pregunta Escala (LIKERT).';
			$preg->TIPR_id = Eva360\TipoPregunta::where('TIPR_descripcion','Escala')->get()->first()->TIPR_id;
	        $preg->PREG_creadopor = $username;
			//Se guarda la pregunta en la encuesta (asociación)
			$encuesta->preguntas()->save($preg);

			//Se guardan opciones de preguntas multiples
			$arrPregItems = [];
			for ($i=1; $i <= 4; $i++) { 
		        $newPregItem = new Eva360\PregItem;
		        $newPregItem->ITPR_texto = 'Opción '.$i;
		        $newPregItem->ITPR_creadopor = $username;
		        //Se guarda la opción en la pregunta (asociación)
		        $preg->itemPregs()->save($newPregItem);
		        array_push($arrPregItems, $newPregItem);
			}

			$this->command->info('--------Respuestas');
			for ($i=0; $i < $cantResp; $i++) {
				foreach ($arrPregItems as $pregItem) {
					$resp = new Eva360\Respuesta;
					$resp->RESP_valor_int = rand(1,5);
					$resp->RESP_valor_str = '';
					$resp->RESP_creadopor = 'RESP'.$i;
					$resp->ITPR_id = $pregItem->ITPR_id;
					$preg->respuestas()->save($resp);
				}
			}



			$this->command->info('------Pregunta Opc unica');
			$preg = new Eva360\Pregunta;
			$preg->PREG_posicion = $encuesta->preguntas()
											->select('PREG_posicion')
											->groupBy('PREG_posicion')
											->get()
											->max('PREG_posicion') + 1;
			$preg->PREG_texto = 'Formulación de pregunta Opc única.';
			$preg->TIPR_id = Eva360\TipoPregunta::where('TIPR_descripcion','Elección única')->get()->first()->TIPR_id;
	        $preg->PREG_creadopor = $username;
			//Se guarda la pregunta en la encuesta (asociación)
			$encuesta->preguntas()->save($preg);

			//Se guardan opciones de preguntas multiples
			$arrPregItems = [];
			for ($i=1; $i <= 4; $i++) { 
		        $newPregItem = new Eva360\PregItem;
		        $newPregItem->ITPR_texto = 'Opción única '.$i;
		        $newPregItem->ITPR_creadopor = $username;
		        //Se guarda la opción en la pregunta (asociación)
		        $preg->itemPregs()->save($newPregItem);
		        array_push($arrPregItems, $newPregItem);
			}

			$this->command->info('--------Respuestas');
			for ($i=0; $i < $cantResp; $i++) {
				$resp = new Eva360\Respuesta;
				$resp->RESP_valor_int = $arrPregItems[rand(0,3)]->ITPR_id;
				$resp->RESP_valor_str = '';
				$resp->RESP_creadopor = 'RESP'.$i;
				$preg->respuestas()->save($resp);
			}


			$this->command->info('------Pregunta Opc multiple');
			$preg = new Eva360\Pregunta;
			$preg->PREG_posicion = $encuesta->preguntas()
											->select('PREG_posicion')
											->groupBy('PREG_posicion')
											->get()
											->max('PREG_posicion') + 1;
			$preg->PREG_texto = 'Formulación de pregunta Opc múltiple.';
			$preg->TIPR_id = Eva360\TipoPregunta::where('TIPR_descripcion','Elección múltiple')->get()->first()->TIPR_id;
	        $preg->PREG_creadopor = $username;
			//Se guarda la pregunta en la encuesta (asociación)
			$encuesta->preguntas()->save($preg);

			//Se guardan opciones de preguntas multiples
			$arrPregItems = [];
			for ($i=1; $i <= 4; $i++) { 
		        $newPregItem = new Eva360\PregItem;
		        $newPregItem->ITPR_texto = 'Opción múltiple '.$i;
		        $newPregItem->ITPR_creadopor = $username;
		        //Se guarda la opción en la pregunta (asociación)
		        $preg->itemPregs()->save($newPregItem);
		        array_push($arrPregItems, $newPregItem);
			}

			$this->command->info('--------Respuestas');
			for ($i=0; $i < $cantResp; $i++) {
				$resp = new Eva360\Respuesta;
				$resp->RESP_valor_int = $arrPregItems[rand(0,3)]->ITPR_id;
				$resp->RESP_valor_str = '';
				$resp->RESP_creadopor = 'RESP'.$i;
				$preg->respuestas()->save($resp);
			}

		$cantEncs  = ['min' => 10, 'max' => 3];
		$cantPregs = ['min' => 4, 'max' => 6];
		$cantResps = ['min' => 5, 'max' => 6];

		$cant = (Integer)($faker->numberBetween($min = $cantEncs['min'], $max = $cantEncs['max']));
		$encuestas = factory(Eva360\Encuesta::class)->times($cant)->create();
		$this->command->info(' '.$cant.' encuestas creadas.');
		foreach($encuestas as $encuesta) {
			$cant = (Integer)($faker->numberBetween($min = $cantPregs['min'], $max = $cantPregs['max']));
			$pregs = factory(Eva360\Pregunta::class)->times($cant)->make();

			foreach($pregs as $preg) {
				$encuesta->preguntas()->save($preg);

				$resps = factory(Eva360\Respuesta::class)->times($cant)->make();
				
				foreach($resps as $resp) {
					$preg->respuestas()->save($resp);
				} //endforeach $resps

				$this->command->info('         '.$cant.' respuestas creadas.');
			} //endforeach $pregs
			$this->command->info('    '.$cant.' preguntas creadas.');
		} //endforeach $encuestas

	*/

		$this->command->info('---FIN EncuestasTableSeeder');
	}
}
