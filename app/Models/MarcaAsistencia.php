<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MarcaAsistencia extends Model
{
    use HasFactory;

    protected $fillable = ['funcionario_id', 'tipo', 'fecha_hora'];

    // Convierte automáticamente fecha_hora a un objeto Carbon
    protected $casts = [
        'fecha_hora' => 'datetime',
    ];
}