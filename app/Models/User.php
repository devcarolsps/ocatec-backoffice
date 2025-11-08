<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use \Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\Uuid;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Uuid;
    use Authorizable, CanResetPassword, MustVerifyEmail;
    use Notifiable;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'documento',
        'data_nascimento',
        'telefone',
        'cod_pais_tel',
        'ddd_tel',
        'celular',
        'cod_pais_cel',
        'ddd_cel',
        'qualificacao',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep_comercial',
        'logradouro_comercial',
        'numero_comercial',
        'complemento_comercial',
        'bairro_comercial',
        'cidade_comercial',
        'estado_comercial',
        'password',
        'logo',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string'
    ];
    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
