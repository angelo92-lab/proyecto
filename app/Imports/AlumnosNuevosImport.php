<?php

namespace App\Imports;

use App\Models\Alumno;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnosNuevosImport implements ToCollection, WithHeadingRow
{
    public $insertados = 0;
    public $omitidos = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $run = trim($row['run']);
            $dv = trim($row['digito_ver']);

            $existe = Alumno::where('run', $run)->exists();

            if (!$existe) {
                Alumno::create([
                    'nombres' => trim($row['nombres']),
                    'apellido_paterno' => trim($row['apellido_paterno']),
                    'apellido_materno' => trim($row['apellido_materno']),
                    'run' => $run,
                    'digito_verificador' => $dv,
                    'curso' => trim($row['desc_grado']),
                ]);
                $this->insertados++;
            } else {
                $this->omitidos++;
            }
        }
    }
}

    

