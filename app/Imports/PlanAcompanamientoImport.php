<?php

namespace App\Imports;

use App\Models\PlanAcompanamiento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlanAcompanamientoImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        dd($row); // Esto detiene la ejecución y te muestra la fila leída
        return new PlanAcompanamiento([
            'curso' => $row['curso'],
            'nombre' => $row['nombre'],
            'procedencia' => $row['procedencia'],
            'asignatura' => $row['asignatura'],
            'asistencia' => $row['asistencia'],
            'acompanamiento' => $row['acompanamiento'],
        ]);
    }
}

