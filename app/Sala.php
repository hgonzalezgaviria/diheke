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
		'SALA_DESCRIPCION',
		'SALA_CAPACIDAD',
		'SALA_FOTOSALA',
		'SALA_FOTOCROQUIS',
		'SALA_OBSERVACIONES',
		'ESTA_ID',
		'SEDE_ID',
		'SALA_CREADOPOR'
	];
    protected $hidden = [
      	"SALA_ID"
    ];


	//Una Sala se encuentra en una Sede
	public function sede()
	{
		$foreingKey = 'SEDE_ID';
		return $this->belongsTo(Sede::class, $foreingKey);
	}

	//Una Sala tiene un estado
	public function estado()
	{
		$foreingKey = 'ESTA_ID';
		return $this->belongsTo(Estado::class, $foreingKey);
	}

    /**
     * Retorna un array de las salas existentes. Se utiliza en Form::select
     *
     * @param  null
     * @return Array
     */
    public static function getSalas()
    {
        $salas = self::orderBy('SALA_ID')
        				//->join('TIPOESTADOS', 'TIPOESTADOS.TIES_ID', '=', 'SALAS.SALA_ID')
        				//->where('TIES_DESCRIPCION', 'ACTIVO')
                        ->select([
                        	'SALA_ID',
                        	'SALA_DESCRIPCION',
							'SALA_CAPACIDAD',
							'SALA_OBSERVACIONES',
							'SEDE_ID',
                        ])
                        ->get();
        return $salas;
    }


    /**
     * Retorna la cantidad de equipos disponibles en la sala.
     *
     * @param  null
     * @return integer
     */
    public function equiposDisp()
    {
    	return false;
	}
}
