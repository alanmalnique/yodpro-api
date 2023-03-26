<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $prob_id
 * @property int $arq_id
 * @property string $probi_descricao
 * @property TblProblema $tblProblema
 * @property TblArquivo $tblArquivo
 */
class ProblemaImagens extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_problemaimagens';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['prob_id', 'arq_id', 'probi_descricao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function problema()
    {
        return $this->belongsTo('App\Http\Model\Problema', 'prob_id', 'prob_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arquivo()
    {
        return $this->belongsTo('App\Http\Model\Arquivo', 'arq_id', 'arq_id');
    }
}
