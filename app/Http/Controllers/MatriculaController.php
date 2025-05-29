<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Matricula;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NuevosMatriculadosImport;

class MatriculaController extends Controller
{
    public function create()
    {
        return view('matricula.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Campos del estudiante
            'curso' => 'required|string|max:100',
            'run' => 'required|string|max:15',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'sexo' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'edad_al_31_marzo' => 'required|integer',
            'nacionalidad' => 'required|string',
            'direccion' => 'required|string|max:255',
            'localidad' => 'nullable|string|max:255',
            'comuna' => 'required|string|max:255',
            'locomocion_municipal' => 'required|boolean',
            'pueblos_originarios' => 'nullable|string|max:255',
            'pertenece_pie' => 'required|boolean',
            'cursos_repetidos' => 'nullable|string|max:255',
            'establecimiento_procedencia' => 'nullable|string|max:255',
            'alergico_medicamentos' => 'required|boolean',
            'enfermedad_diagnosticada' => 'nullable|string|max:255',

            // Padres y tutor
            'padre_nombre' => 'nullable|string|max:255',
            'padre_nivel_educacional' => 'nullable|string|max:255',
            'madre_nombre' => 'nullable|string|max:255',
            'madre_nivel_educacional' => 'nullable|string|max:255',
            'tutor_nombre' => 'nullable|string|max:255',
            'tutor_nivel_educacional' => 'nullable|string|max:255',
            'personas_con_quien_vive' => 'nullable|string',
            'tipo_vivienda' => 'nullable|string|in:propia,cedida,arrendada',
            'posee_luz' => 'required|boolean',
            'posee_alcantarillado' => 'required|boolean',

            // Apoderado titular
            'apoderado_nombre' => 'nullable|string|max:255',
            'apoderado_domicilio' => 'nullable|string|max:255',
            'apoderado_telefono' => 'nullable|string|max:20',

            // Apoderado suplente
            'suplente_nombre' => 'nullable|string|max:255',
            'suplente_domicilio' => 'nullable|string|max:255',
            'suplente_telefono' => 'nullable|string|max:20',
            'autoriza_retiro_suplente' => 'nullable|boolean',

            // Contacto de emergencia
            'emergencia_contacto_nombre' => 'nullable|string|max:255',
            'emergencia_contacto_celular' => 'nullable|string|max:20',

            // Responsable ficha
            'responsable_ficha_nombre' => 'nullable|string|max:255',
            'responsable_ficha_firma' => 'nullable|string|max:255', // O puedes capturar un "sí/no" o subir imagen en el futuro
            'responsable_ficha_fecha' => 'nullable|date',


        ]);

        DB::table('matriculas_2026')->insert([
            // Estudiante
            'curso' => $request->curso,
            'run' => $request->run,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombres' => $request->nombres,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad_al_31_marzo' => $request->edad_al_31_marzo,
            'nacionalidad' => $request->nacionalidad,
            'direccion' => $request->direccion,
            'localidad' => $request->localidad,
            'comuna' => $request->comuna,
            'locomocion_municipal' => $request->locomocion_municipal,
            'pueblos_originarios' => $request->pueblos_originarios,
            'pertenece_pie' => $request->pertenece_pie,
            'cursos_repetidos' => $request->cursos_repetidos,
            'establecimiento_procedencia' => $request->establecimiento_procedencia,
            'alergico_medicamentos' => $request->alergico_medicamentos,
            'enfermedad_diagnosticada' => $request->enfermedad_diagnosticada,

            // Padres y tutor
            'padre_nombre' => $request->padre_nombre,
            'padre_nivel_educacional' => $request->padre_nivel_educacional,
            'madre_nombre' => $request->madre_nombre,
            'madre_nivel_educacional' => $request->madre_nivel_educacional,
            'tutor_nombre' => $request->tutor_nombre,
            'tutor_nivel_educacional' => $request->tutor_nivel_educacional,
            'personas_con_quien_vive' => $request->personas_con_quien_vive,

            'tipo_vivienda' => $request->tipo_vivienda,
            'posee_luz' => $request->has('posee_luz'),
            'posee_alcantarillado' => $request->has('posee_alcantarillado'),

            // Apoderado titular
            'apoderado_nombre' => $request->apoderado_nombre,
            'apoderado_domicilio' => $request->apoderado_domicilio,
            'apoderado_telefono' => $request->apoderado_telefono,

            // Apoderado suplente
            'suplente_nombre' => $request->suplente_nombre,
            'suplente_domicilio' => $request->suplente_domicilio,
            'suplente_telefono' => $request->suplente_telefono,
            'autoriza_retiro_suplente' => $request->has('autoriza_retiro_suplente'),

            // Contacto de emergencia
            'emergencia_contacto_nombre' => $request->emergencia_contacto_nombre,
            'emergencia_contacto_celular' => $request->emergencia_contacto_celular,

            // Responsable ficha
            'responsable_ficha_nombre' => $request->responsable_ficha_nombre,
            'responsable_ficha_firma' => $request->responsable_ficha_firma,
            'responsable_ficha_fecha' => $request->responsable_ficha_fecha,


            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('matricula.create')->with('success', 'Matrícula ingresada correctamente.');
    }

    public function reportes(Request $request)
{
    $query = DB::table('matriculas_2026');

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nombres', 'like', "%{$search}%")
              ->orWhere('apellido_paterno', 'like', "%{$search}%")
              ->orWhere('apellido_materno', 'like', "%{$search}%")
              ->orWhere('curso', 'like', "%{$search}%");
        });
    }

    $matriculas = $query->get();

    return view('matricula.reportes', compact('matriculas'));
}


public function exportarPDF(Request $request)
{
    $query = Matricula::query(); 

    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nombres', 'like', '%' . $request->search . '%')
              ->orWhere('apellido_paterno', 'like', '%' . $request->search . '%')
              ->orWhere('apellido_materno', 'like', '%' . $request->search . '%')
              ->orWhere('curso', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('curso')) {
        $query->where('curso', $request->curso);
    }

    $matriculas = $query->get();

    $pdf = Pdf::loadView('matricula.pdf', compact('matriculas'));

    return $pdf->download('reporte_matriculas.pdf');
}

public function importarNuevos(Request $request)
{
    $request->validate([
        'archivo' => 'required|file|mimes:xlsx,xls',
    ]);

    Excel::import(new NuevosMatriculadosImport, $request->file('archivo'));

    return back()->with('success', 'Alumnos nuevos importados correctamente.');
}

}