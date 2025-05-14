<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaAsistencia extends Model
{
    use HasFactory;

    protected $fillable = ['funcionario_id', 'tipo', 'fecha_hora'];

    // Relación inversa
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
