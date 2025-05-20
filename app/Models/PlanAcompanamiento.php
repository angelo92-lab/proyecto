<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanAcompanamiento extends Model
{
    use HasFactory;

    // Lista de atributos que se pueden asignar masivamente
    protected $fillable = [
        'curso',
        'nombre',
        'procedencia',
        'asignatura',
        'asistencia',
        'acompanamiento',
    ];
}
