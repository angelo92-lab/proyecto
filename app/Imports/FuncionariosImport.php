<?php

namespace App\Imports;

use App\Models\Funcionario;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class FuncionariosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Aquí mostramos la colección de datos leída del archivo Excel
        dd($rows); // Esto nos ayudará a verificar si Laravel está leyendo bien los datos del archivo
    }
}
