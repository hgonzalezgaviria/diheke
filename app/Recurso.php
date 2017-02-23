<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurso extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'RECURSOS';
    protected $primaryKey = 'RECU_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'RECU_FECHACREADO';
	const UPDATED_AT = 'RECU_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'RECU_FECHAELIMINADO';
	protected $dates = ['RECU_FECHAELIMINADO'];
	
	protected $fillable = [
		'RECU_DESCRIPCION', 'RECU_VERSION', 'RECU_OBSERVACIONES'
	];

    protected $hidden = [
      	"RECU_ID"
    ];


	/*
	 * Muchos a muchos...
	 */
	public function salas()
	{
		$foreingKey = 'RECU_ID';
		$otherKey   = 'SALA_ID';
		return $this->belongsToMany(Sala::class, 'RECURSOSALAS', $foreingKey,  $otherKey);
	}


    /**
     * Retorna un array de las recursos exiStentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getRecursos()
    {
        $recursos = self::with('salas')->orderBy('RECU_ID') 
        //$salas = self::with('recursos')->orderBy('SALA_ID')
        				//->where('RECU_ESTADO', 'ACTIVO')
                        ->select([
                        	'RECU_ID',
                        	'RECU_DESCRIPCION',
                        	'RECU_VERSION',
                        	'RECU_OBSERVACIONES',
                        ])->get();

        return $recursos;
    }

}
