<?php

namespace App\Http\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $usu_id
 * @property int $arq_id
 * @property string $usu_nome
 * @property string $usu_email
 * @property string $usu_celular
 * @property boolean $usu_ativo
 * @property string $usu_tokenpush
 * @property string $usu_dthrcadastro
 * @property TblArquivo $tblArquivo
 * @property TblProblema[] $tblProblemas
 * @property TblProblemacomentario[] $tblProblemacomentarios
 */
class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tbl_usuario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'usu_id';

    /**
     * Ignoring timestamps.
     * 
     * @var string
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['arq_id', 'usu_nome', 'usu_email', 'usu_celular', 'usu_senha', 'usu_ativo', 'usu_tokenpush', 'usu_dthrcadastro'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usu_senha',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function arquivo()
    {
        return $this->belongsTo('App\Http\Model\Arquivo', 'arq_id', 'arq_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function problemas()
    {
        return $this->hasMany('App\Http\Model\Problema', 'usu_id', 'usu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios()
    {
        return $this->hasMany('App\Http\Model\ProblemaComentarios', 'usu_id', 'usu_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
