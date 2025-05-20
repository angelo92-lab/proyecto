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
    // Ignorar filas que no tengan valores esenciales
    if (empty($row['curso']) || empty($row['nombre'])) {
        return null;
    }

    return new PlanAcompanamiento([
        'curso' => $row['curso'],
        'nombre' => $row['nombre'],
        'procedencia' => $row['procedencia'] ?? null,
        'asignatura' => $row['asignatura'],
        'asistencia' => $row['asistencia'] ?? null,
        'acompanamiento' => $row['acompanamiento'],
    ]);
}
}

