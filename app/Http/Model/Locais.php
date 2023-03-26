<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $loc_id
 * @property string $loc_descricao
 * @property string $loc_endereco
 * @property string $loc_latitude
 * @property string $loc_longitude
 * @property boolean $loc_ativo
 * @property string $loc_dthrcadastro
 * @property TblProblema[] $tblProblemas
 */
class Locais extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_locais';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'loc_id';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['loc_descricao', 'loc_endereco', 'loc_latitude', 'loc_longitude', 'loc_ativo', 'loc_dthrcadastro'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function problemas()
    {
        return $this->hasMany('App\Http\Model\Problema', 'loc_id', 'loc_id');
    }
}
