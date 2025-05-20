<?php

namespace App\Imports;

use App\Models\PlanAcompanamiento;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PlanAcompanamientoImport implements OnEachRow, WithHeadingRow
{
    public function headingRow(): int
    {
        return 3; // Encabezados están en la fila 3
    }

    public function onRow(Row $row)
    {
        $r = $row->toArray();

        if (empty($r['curso']) || empty($r['nombre'])) return;

        PlanAcompanamiento::create([
            'curso'         => $r['curso'] ?? '',
            'nombre'        => $r['nombre'] ?? '',
            'procedencia'   => $r['procedencia'] ?? '',
            'asignatura'    => $r['asignatura'] ?? '',
            'asistencia'    => is_numeric($r['asistencia']) ? intval($r['asistencia']) : null,
            'acompanamiento'=> $r['acompanamiento'] ?? '',
        ]);
    }
}
