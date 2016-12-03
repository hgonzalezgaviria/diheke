<?php

namespace reservas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspacioFisico extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'ESPACIOFISICO';
    protected $primaryKey = 'ESFI_ID';

	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'ESFI_FECHACREADO';
	const UPDATED_AT = 'ESFI_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'ESFI_FECHAELIMINADO';
	protected $dates = ['ESFI_FECHAELIMINADO'];
	
	protected $fillable = [
		'ESFI_DESCRIPCION',
		'ESFI_NOMBRE',
		'ESFI_NRONIVELES',
		'ESFI_NOMENCLATURA',
		'ESFI_AREA',
		'ESFI_CREADOPOR',
		'ESFI_MODIFICADOPOR'
	];

	//Un EspacioFisico tiene un TipoEspacioFisico
	public function tipoEspacioFisico()
	{
		$foreingKey = 'TIEF_ID';
		return $this->belongsTo(TipoEspacioFisico::class, $foreingKey);
	}

	//Un EspacioFisico tiene un TipoPosesion
	public function tipoPosesion()
	{
		$foreingKey = 'TIPO_ID';
		return $this->belongsTo(TipoPosesion::class, $foreingKey);
	}
	
	//Un EspacioFisico tiene una Localidad
	public function localidad()
	{
		$foreingKey = 'LOCA_ID';
		return $this->belongsTo(Localidad::class, $foreingKey);
	}

	//Un EspacioFisico tiene muchos RecursoFisico
	public function recursosFisicos()
	{
		$foreingKey = 'ESFI_ID';
		return $this->hasMany(RecursoFisico::class, $foreingKey);
	}
	

    /**
     * Retorna un array de las recursos existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getEspaciosFisicos()
    {
        $espacios = self::orderBy('ESFI_ID')
        				//->where('REFI_ESTADO', 'ACTIVO')
                        ->select([
                        	'ESFI_ID',
                        	'ESFI_DESCRIPCION',
                        	])
                        ->get();

        return $espacios;
    }

}
