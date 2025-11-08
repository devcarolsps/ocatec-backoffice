<?php


namespace App\Models;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Hospedagens extends Model
{
    use Uuid;

    /**
     * @var string
     */
    protected $table = 'hospedagens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'nome_empreendimento',
        'comissao_oca',
        'comissao_total',
        'permite_afiliacao',
        'primeira_indicacao',
        'regiao_comercializacao',
        'regra_afiliacao',
        'regra_comissionamento',
        'segunda_indicacao',
        'tipo_afiliacao',
        'recomendado',
        'codigo',
        'caracteristica_descricao',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

}
