<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'RECURSOS';
    protected $primaryKey = 'SALA_id';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'SALA_FECHACREADO';
	const UPDATED_AT = 'SALA_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'SALA_FECHAELIMINADO';
	protected $dates = ['SALA_FECHAELIMINADO'];
	
	protected $fillable = [
		'SALA_descripcion', 'SALA_version', 'SALA_observaciones'
	];

    protected $hidden = [
      	"SALA_id"
    ];


	/*
	 * Muchos a muchos...
	 */
	public function salas()
	{
		$foreingKey = 'RECU_ID';
		$otherKey   = 'SALA_id';
		return $this->belongsToMany(Recurso::class, 'RECURSOSALAS', $foreingKey,  $otherKey);
	}


    /**
     * Retorna un array de las recursos existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getRecursos()
    {
        $recursos = self::orderBy('SALA_ID')
        				//->where('SALA_ESTADO', 'ACTIVO')
                        ->select([
                        	'SALA_descripcion',
                        	'SALA_version',
                        	'SALA_observaciones',
                        ])->get();

        return $recursos;
    }

}
