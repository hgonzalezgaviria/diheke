<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurso extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'RECURSOS';
    protected $primaryKey = 'RECU_id';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'RECU_FECHACREADO';
	const UPDATED_AT = 'RECU_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'RECU_FECHAELIMINADO';
	protected $dates = ['RECU_FECHAELIMINADO'];
	
	protected $fillable = [
		'RECU_descripcion', 'RECU_version', 'RECU_observaciones'
	];

    protected $hidden = [
      	"RECU_id"
    ];


	/*
	 * Muchos a muchos...
	 */
	public function salas()
	{
		$foreingKey = 'RECU_id';
		$otherKey   = 'SALA_id';
		return $this->belongsToMany(Sala::class, 'RECURSOSALAS', $foreingKey,  $otherKey);
	}


    /**
     * Retorna un array de las recursos existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getRecursos()
    {
        $recursos = self::orderBy('RECU_id')
        				//->where('RECU_ESTADO', 'ACTIVO')
                        ->select([
                        	'RECU_descripcion',
                        	'RECU_version',
                        	'RECU_observaciones',
                        ])->get();

        return $recursos;
    }

}
