<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'colegio20252';

    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'run',
        'digito_ver',
        'desc_grado',
    ];

    public $timestamps = false; // o true si tu tabla tiene `created_at`, `updated_at`
}
