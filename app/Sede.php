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
		'SEDE_NOMBRE',
		'SEDE_NRONIVELES',
		'SEDE_NOMENCLATURA',
		'SEDE_AREA',
		'SEDE_CREADOPOR',
		'SEDE_MODIFICADOPOR'
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
		$foreingKey = 'SEDE_ID';
		return $this->hasMany(RecursoFisico::class, $foreingKey);
	}
	

    /**
     * Retorna un array de las recursos existentes. Se utiliza en Form::select
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
