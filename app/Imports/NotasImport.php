<?php

namespace App\Imports;

use App\Models\Nota;
use App\Models\Alumno;   // ← asegurarnos de tener el modelo
use Maatwebsite\Excel\Concerns\{
    ToModel, WithHeadingRow, WithValidation
};

class NotasImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // 1. Obtener o crear el alumno por su nombre
        $alumno = Alumno::firstOrCreate(
            ['nombre' => trim($row['alumno'])]       // encabezado “alumno”
        );

        // 2. Traducir semestre (si pones “FINAL” en tu archivo lo convierto en 0)
        $sem = strtoupper($row['semestre']) === 'FINAL'
             ? 0
             : (int)$row['semestre'];

        // 3. Guardar / actualizar la nota
        return Nota::updateOrCreate(
            [
                'alumno'  => $alumno->id,
                'curso'      => trim($row['curso']),
                'asignatura' => trim($row['asignatura']),
                'semestre'   => $sem,
            ],
            ['nota' => $row['nota']]
        );
    }

    /** Validaciones de cada fila */
    public function rules(): array
    {
        return [
            '*.alumno'     => ['required', 'string'],
            '*.curso'      => ['required', 'string'],
            '*.asignatura' => ['required', 'string'],
            '*.semestre'   => ['required'],
            '*.nota'       => ['required', 'numeric', 'between:1,7'], // ajusta escala
        ];
    }
}
