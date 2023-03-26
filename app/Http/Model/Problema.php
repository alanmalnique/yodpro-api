<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $prob_id
 * @property int $usu_id
 * @property int $loc_id
 * @property string $prob_datahora
 * @property string $prob_descricao
 * @property boolean $prob_status
 * @property string $prob_dthrfinalizado
 * @property TblLocai $tblLocai
 * @property TblUsuario $tblUsuario
 * @property TblProblemacomentario[] $tblProblemacomentarios
 * @property TblProblemaimagen[] $tblProblemaimagens
 */
class Problema extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_problema';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'prob_id';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['usu_id', 'loc_id', 'prob_datahora', 'prob_titulo', 'prob_descricao', 'prob_status', 'prob_dthrfinalizado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local()
    {
        return $this->belongsTo('App\Http\Model\Locais', 'loc_id', 'loc_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Http\Model\Usuario', 'usu_id', 'usu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios()
    {
        return $this->hasMany('App\Http\Model\ProblemaComentario', 'prob_id', 'prob_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagens()
    {
        return $this->hasMany('App\Http\Model\ProblemaImagens', 'prob_id', 'prob_id');
    }
}
