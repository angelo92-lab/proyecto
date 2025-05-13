<?php

namespace App\Imports;

use App\Models\Funcionario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomStartRow;

class FuncionariosImport implements ToModel, WithHeadingRow, WithCustomStartRow
{
    public function model(array $row)
    {
        dd($row);
        return new Funcionario([
            'rut' => $row['rut'],       // encabezado en minúscula
            'nombre' => $row['nombre']
        ]);
    }

    // Le decimos que los encabezados están en la fila 2
    public function startRow(): int
    {
        return 2;
    }
}
