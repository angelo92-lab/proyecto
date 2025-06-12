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
        return view('matricula.create'); // Asegúrate de que esta vista exista
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'run' => 'required|string|max:12',
            'curso' => 'nullable|string|max:50',
            'sexo' => 'nullable|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'edad_al_31_marzo' => 'nullable|integer',
            'nacionalidad' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'localidad' => 'nullable|string|max:100',
            'comuna' => 'nullable|string|max:100',
            'requiere_locomocion' => 'nullable|string|max:10',
            'pueblos_originarios' => 'nullable|string|max:10',
            'pueblo_especifico' => 'nullable|string|max:100',
            'programa_integracion' => 'nullable|string|max:10',
            'cursos_repetidos' => 'nullable|string|max:100',
            'establecimiento_procedencia' => 'nullable|string|max:255',
            'alergias' => 'nullable|string|max:10',
            'alergias_detalle' => 'nullable|string|max:255',
            'enfermedad_diagnosticada' => 'nullable|string|max:255',
            'padre_nombre' => 'nullable|string|max:255',
            'padre_nivel_educacional' => 'nullable|string|max:100',
            'madre_nombre' => 'nullable|string|max:255',
            'madre_nivel_educacional' => 'nullable|string|max:100',
            'tutor_nombre' => 'nullable|string|max:255',
            'tutor_nivel_educacional' => 'nullable|string|max:100',
            'personas_con_quien_vive' => 'nullable|string|max:255',
            'tipo_vivienda' => 'nullable|string|max:100',
            'posee_luz' => 'nullable|string|max:10',
            'posee_alcantarillado' => 'nullable|string|max:10',
            'apoderado_nombre' => 'nullable|string|max:255',
            'apoderado_domicilio' => 'nullable|string|max:255',
            'apoderado_telefono' => 'nullable|string|max:50',
            'suplente_nombre' => 'nullable|string|max:255',
            'suplente_domicilio' => 'nullable|string|max:255',
            'suplente_telefono' => 'nullable|string|max:50',
            'autoriza_suplente' => 'nullable|string|max:10',
            'emergencia_nombre' => 'nullable|string|max:255',
            'emergencia_celular' => 'nullable|string|max:50',
            'responsable_ficha' => 'nullable|string|max:255',
            'firma_responsable' => 'nullable|string|max:255',
            'fecha_ficha' => 'nullable|date',
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
            'requiere_locomocion' => $request->requiere_locomocion,
            'pueblos_originarios' => $request->pueblos_originarios,
            'programa_integracion' => $request->programa_integracion,
            'cursos_repetidos' => $request->cursos_repetidos,
            'establecimiento_procedencia' => $request->establecimiento_procedencia,
            'alergias' => $request->boolean('alergias'),
            'alergias_detalle' => $request->alergias_detalle,
            'enfermedad_diagnosticada' => $request->enfermedad_diagnosticada,   
            
            'padre_nombre' => $request->padre_nombre,
            'padre_nivel_educacional' => $request->padre_nivel_educacional,
            'madre_nombre' => $request->madre_nombre,
            'madre_nivel_educacional' => $request->madre_nivel_educacional,
            'tutor_nombre' => $request->tutor_nombre,
            'tutor_nivel_educacional' => $request->tutor_nivel_educacional,
            'personas_con_quien_vive' => $request->personas_con_quien_vive,

            'tipo_vivienda' => $request->tipo_vivienda,
            'posee_luz' => $request->boolean('posee_luz'),
            'posee_alcantarillado' => $request->boolean('posee_alcantarillado'),

            'apoderado_nombre' => $request->apoderado_nombre,
            'apoderado_domicilio' => $request->apoderado_domicilio,
            'apoderado_telefono' => $request->apoderado_telefono,

            'suplente_nombre' => $request->suplente_nombre,
            'suplente_domicilio' => $request->suplente_domicilio,
            'suplente_telefono' => $request->suplente_telefono,
           'autoriza_suplente' => $request->boolean('autoriza_retiro_suplente'),

            'emergencia_nombre' => $request->emergencia_nombre,
            'emergencia_celular' => $request->emergencia_celular,

            'responsable_ficha' => $request->responsable_ficha,
            'firma_responsable' => $request->firma_responsable,
            'fecha_ficha' => $request->fecha_ficha,


            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('matricula.create')->with('success', '✅ Matrícula guardada correctamente.');

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

    if ($request->filled('curso')) {
    $query->where('curso', $request->curso);
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

    $matriculas = $query->get();

    $pdf = Pdf::loadView('matricula.pdf', compact('matriculas'));

    return $pdf->download('reporte_matriculas.pdf');
}

public function show($id)
{
    $matricula = Matricula::findOrFail($id);
    return view('matricula.show', compact('matricula'));
}


public function descargarPDF($id)
{
    $matricula = Matricula::findOrFail($id);
    $pdf = Pdf::loadView('matricula.pdf2', compact('matricula'));

    $nombreArchivo = 'Ficha_Matricula_' . $matricula->nombres . '_' . $matricula->apellido_paterno . '.pdf';
    return $pdf->download($nombreArchivo);
}

public function dashboard()
{
    $total = DB::table('matriculas_2026')->count();

    $porCurso = DB::table('matriculas_2026')
        ->select('curso', DB::raw('count(*) as total'))
        ->groupBy('curso')
        ->get();

    $porSexo = DB::table('matriculas_2026')
        ->select('sexo', DB::raw('count(*) as total'))
        ->groupBy('sexo')
        ->get();

    $porComuna = DB::table('matriculas_2026')
        ->select('comuna', DB::raw('count(*) as total'))
        ->groupBy('comuna')
        ->get();

    // NUEVAS MÉTRICAS
    $conAlergias = DB::table('matriculas_2026')->where('alergias', 1)->count();
    $conEnfermedades = DB::table('matriculas_2026')->whereNotNull('enfermedad_diagnosticada')->where('enfermedad_diagnosticada', '!=', '')->count();
    $requiereLocomocion = DB::table('matriculas_2026')->where('requiere_locomocion', 'Sí')->count();

    $porVivienda = DB::table('matriculas_2026')
        ->select('tipo_vivienda', DB::raw('count(*) as total'))
        ->groupBy('tipo_vivienda')
        ->get();

    $pueblosOriginarios = DB::table('matriculas_2026')
        ->select('pueblos_originarios', DB::raw('count(*) as total'))
        ->groupBy('pueblos_originarios')
        ->get();

    $procedencia = DB::table('matriculas_2026')
        ->select('establecimiento_procedencia', DB::raw('count(*) as total'))
        ->groupBy('establecimiento_procedencia')
        ->orderByDesc('total')
        ->limit(10)
        ->get();

    return view('matricula.dashboard', compact(
        'total', 'porCurso', 'porSexo', 'porComuna',
        'conAlergias', 'conEnfermedades', 'requiereLocomocion',
        'porVivienda', 'pueblosOriginarios', 'procedencia'
    ));
}   

public function editar($id)
{
    $alumno = Alumno::findOrFail($id);

    // Puedes adaptar los datos que quieres precargar en el formulario
    return view('matricula.create', compact('alumno'));
}




}   