<?php
namespace reservas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
	//Nombre de la tabla en la base de datos
	protected $table = 'SALAS';
    protected $primaryKey = 'SALA_ID';
	//Traza: Nombre de campos en la tabla para auditoría de cambios
	const CREATED_AT = 'SALA_FECHACREADO';
	const UPDATED_AT = 'SALA_FECHAMODIFICADO';
	use SoftDeletes;
	const DELETED_AT = 'SALA_FECHAELIMINADO';
	protected $dates = ['SALA_FECHAELIMINADO'];
	
	protected $fillable = [
		'SALA_NOMENCLATURA',
		'SALA_CAPACIDADMAXIMA',
		'SALA_TIPOASIGNACION',
		'SALA_DESCRIPCION',
		'SALA_NIVEL',
		'SALA_ESTADO',
		'SALA_CAPACIDADREAL',
		'SALA_PRESTABLE',
		'SALA_AREAREAL',
		'SALA_AREAUSADA',
	];
    protected $hidden = [
      	"SALA_ID"
    ];
	//Un RecursoFisico tiene un EspacioFisico
	public function espacioFisico()
	{
		$foreingKey = 'ESFI_ID';
		return $this->belongsTo(EspacioFisico::class, $foreingKey);
	}
	
	//Un RecursoFisico tiene un TipoPosesion
	public function tipoPosesion()
	{
		$foreingKey = 'TIPO_ID';
		return $this->belongsTo(TipoPosesion::class, $foreingKey);
	}
	//Un RecursoFisico tiene una SituacionRecursoFisico
	public function situacionRecursoFisico()
	{
		$foreingKey = 'SIRF_ID';
		return $this->belongsTo(SituacionRecursoFisico::class, $foreingKey);
	}
	//Un RecursoFisico tiene un TipoRecursoFisico
	public function tipoRecursoFisico()
	{
		$foreingKey = 'TIRF_ID';
		return $this->belongsTo(TipoRecursoFisico::class, $foreingKey);
	}
    /**
     * Retorna un array de las recursos existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getSalas()
    {
        $recursos = self::orderBy('SALA_ID')
        				//->where('SALA_ESTADO', 'ACTIVO')
                        ->select([
                        	'SALA_ID',
                        	'SALA_NOMENCLATURA',
                        	'SALA_DESCRIPCION',
							'SALA_ESTADO',
							'SALA_CAPACIDADREAL',
							'SALA_PRESTABLE',
							'ESFI_ID',
                        ])
                        ->get();
        return $recursos;
    }




}
