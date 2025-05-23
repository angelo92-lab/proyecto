<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Aquí defines el nombre real de la tabla:
    protected $table = 'usuarios';

    // Define los campos que puedes llenar masivamente
    protected $fillable = [
        'username',
        'password',
        'es_funcionario',
        'rol',
    ];

    // Campos ocultos al serializar (ejemplo al convertir a JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Castings para atributos específicos
    protected $casts = [
        'es_funcionario' => 'boolean',
        'password' => 'hashed',
    ];

    // Si usas remember_token, agrega esta propiedad
    public $timestamps = false; // si tu tabla no tiene columnas created_at, updated_at

    // Puedes agregar aquí métodos personalizados o relaciones si las necesitas
}

