<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','cedula', 'rol' , 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidade::class)->withTimestamps();
    }

    public function scopeOdontologos($query)
    {
        return $query->where('rol', 'odontologo');
    }

    public function scopeRecepcionistas($query)
    {
        return $query->where('rol', 'recepcionista');
    }

    public function scopeAdministradores($query)
    {
        return $query->where('rol', 'admin');
    }
}
