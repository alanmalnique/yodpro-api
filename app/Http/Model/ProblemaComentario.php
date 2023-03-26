<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $probc_id
 * @property int $prob_id
 * @property int $usu_id
 * @property string $probc_datahora
 * @property string $probc_comentario
 * @property boolean $probc_ativo
 * @property TblProblema $tblProblema
 * @property TblUsuario $tblUsuario
 */
class ProblemaComentario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_problemacomentario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'probc_id';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['prob_id', 'usu_id', 'probc_datahora', 'probc_comentario', 'probc_ativo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function problema()
    {
        return $this->belongsTo('App\Http\Model\problema', 'prob_id', 'prob_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Http\Model\Usuario', 'usu_id', 'usu_id');
    }
}
