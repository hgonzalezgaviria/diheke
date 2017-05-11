<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materia extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'MATERIAS';
    protected $primaryKey = 'MATE_CODIGOMATERIA';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'MATE_FECHACREADO';
	const UPDATED_AT = 'MATE_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'MATE_FECHAELIMINADO';
	protected $dates = ['MATE_FECHAELIMINADO'];
	

	protected $fillable = [
		'MATE_NOMBRE',
		'UNID_ID'
	];

	//Una Sede tiene muchas Salas
	public function salas()
	{
		$foreingKey = 'UNID_ID';
		return $this->hasMany(Unidad::class, $foreingKey);
	}
	

    /**
     * Retorna un array de las sedes existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    /*
    public static function getSedes()
    {
        $espacios = self::orderBy('MATE_ID')
        				//->where('REFI_ESTADO', 'ACTIVO')
                        ->select([
                        	'MATE_ID',
                        	'MATE_DESCRIPCION',
                        	])
                        ->get();

        return $espacios;
    }
    */

}
