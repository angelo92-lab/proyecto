<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlanAcompanamientoImport implements ToModel, WithHeadingRow
{
    public function headingRow(): int
    {
        return 3; // Los encabezados están en la fila 3
    }

    public function model(array $row)
    {
        // Aquí deben coincidir los nombres con los encabezados (en minúsculas, sin tildes ni espacios)
        return new PlanAcompanamiento([
            'curso'         => $row['curso'],
            'nombre'        => $row['nombre'],
            'procedencia'   => $row['procedencia'],
            'asignatura'    => $row['asignatura'],
            'asistencia'    => $row['asistencia'],
            'acompanamiento'=> $row['acompanamiento'],
        ]);
    }
}
