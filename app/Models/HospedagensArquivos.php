<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuid;

class HospedagensArquivos extends Model
{
    use Uuid;

    /**
     * @var string
     */
    protected $table = 'hospedagens_arquivos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'hospedagem_id',
        'filename',
        'extension',
        'size',
        'tipo',
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
