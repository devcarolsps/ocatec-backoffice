<?php


namespace App\Models;


use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Afiliacao extends Model
{
    use Uuid;

    /**
     * @var string
     */
    protected $table = 'afiliacao';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'hospedagem_id',
        'status',
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
