<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionario;

class MarcaAsistencia extends Model
{
    protected $fillable = ['funcionario_id', 'tipo', 'fecha_hora'];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
