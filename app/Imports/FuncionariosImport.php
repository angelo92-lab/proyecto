<?php

namespace App\Imports;

use App\Models\Funcionario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FuncionariosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Funcionario([
            'rut' => $row['rut'],      // minúsculas si en el Excel están como "rut"
            'nombre' => $row['nombre']
        ]);
    }
}


