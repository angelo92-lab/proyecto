<?php

namespace App\Imports;

use App\Models\Funcionario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;  // Importar este trait para manejar las cabeceras

class FuncionariosImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Asegúrate de que las columnas 'RUT' y 'Nombre' existen en la fila
        if (isset($row['RUT']) && isset($row['Nombre'])) {
            return new Funcionario([
                'rut' => $row['RUT'],  // Usa los nombres de las cabeceras
                'nombre' => $row['Nombre'],  // Usa los nombres de las cabeceras
            ]);
        }

        return null;  // Si no hay datos válidos, no se importa nada
    }
}

