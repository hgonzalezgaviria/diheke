<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'SEDES';
    protected $primaryKey = 'SEDE_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'SEDE_FECHACREADO';
	const UPDATED_AT = 'SEDE_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'SEDE_FECHAELIMINADO';
	protected $dates = ['SEDE_FECHAELIMINADO'];
	

	protected $fillable = [
		'SEDE_DESCRIPCION',
		'SEDE_DIRECCION',
		'SEDE_OBSERVACIONES',
		'SEDE_CREADOPOR',
	];

	//Una Sede tiene muchas Salas
	public function salas()
	{
		$foreingKey = 'SEDE_ID';
		return $this->hasMany(Sala::class, $foreingKey);
	}
	

    /**
     * Retorna un array de las sedes existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getSedes()
    {
        $espacios = self::orderBy('SEDE_ID')
        				//->where('REFI_ESTADO', 'ACTIVO')
                        ->select([
                        	'SEDE_ID',
                        	'SEDE_DESCRIPCION',
                        	])
                        ->get();

        return $espacios;
    }

}
