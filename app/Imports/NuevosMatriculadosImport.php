<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use App\Models\Matricula;

class NuevosMatriculadosImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $data = $row->toArray();

        $run = $data['run'];

        // Verificamos si ya está en colegio20252
        $existe = DB::table('colegio20252')->where('run', $run)->exists();

        if (!$existe) {
            // Insertamos en matriculas_2026
            Matricula::create([
                'run' => $run,
                'nombres' => $data['nombres'] ?? '',
                'apellido_paterno' => $data['apellido_paterno'] ?? '',
                'apellido_materno' => $data['apellido_materno'] ?? '',
                'curso' => $data['curso'] ?? '',
                // Agrega aquí los demás campos necesarios
            ]);
        }
    }
}

