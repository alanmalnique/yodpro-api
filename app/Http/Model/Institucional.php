<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $inst_id
 * @property int $arq_id
 * @property string $inst_titulo
 * @property string $inst_texto
 * @property integer $inst_ativo
 * @property integer $inst_tipo
 * @property TblArquivo $tblArquivo
 */
class Institucional extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_institucional';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'inst_id';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['arq_id', 'inst_titulo', 'inst_texto', 'inst_ativo', 'inst_tipo'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arquivo()
    {
        return $this->belongsTo('App\Http\Model\Arquivo', 'arq_id', 'arq_id');
    }
}
