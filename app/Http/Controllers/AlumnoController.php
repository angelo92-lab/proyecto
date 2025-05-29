<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumnosNuevosImport;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function __construct()
    {
        // Asegura que todas las funciones de este controlador estén protegidas
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Obtener cursos
        $cursos = DB::table('colegio20252')->distinct()->pluck('Curso')->sort();

        // Obtener parámetros de la solicitud
        $cursoSeleccionado = $request->input('curso', '');
        $fechaSeleccionada = $request->input('fecha', date('Y-m-d'));

        // Construir la consulta
        $query = DB::table('colegio20252 as a')
            ->leftJoin('almuerzos as al', function ($join) use ($fechaSeleccionada) {
                $join->on('a.Run', '=', 'al.rut_alumno')
                     ->where('al.fecha', '=', $fechaSeleccionada);
            })
            ->select(
                'a.Nombres',
                DB::raw('`a`.`Apellido Paterno` as ApellidoPaterno'),
                DB::raw('`a`.`Apellido Materno` as ApellidoMaterno'),
                'a.Run',
                DB::raw('`a`.`Digito Ver` as DigitoVer'),
                'a.Curso',
                DB::raw("CASE WHEN al.almorzo = 1 THEN 'Sí' ELSE 'No' END AS almorzo_por_fecha")
            );

        if ($cursoSeleccionado) {
            $query->where('a.Curso', $cursoSeleccionado);
        }

        $alumnos = $query->get();

        return view('alumnoscasino', compact('cursos', 'cursoSeleccionado', 'fechaSeleccionada', 'alumnos'));
    }

    public function mostrarFormularioImportar()
{
    return view('alumnos.importar');
}

    public function importarExcel(Request $request)
{
    $request->validate([
        'archivo' => 'required|mimes:xlsx,xls'
    ]);

    $archivo = $request->file('archivo');

    $datos = Excel::toArray([], $archivo)[0];

    foreach ($datos as $index => $fila) {
        if ($index == 0) continue;

        if (count($fila) < 6) continue;

        $run = preg_replace('/[^0-9]/', '', $fila[3]);
        $digito = strtoupper(trim($fila[4]));

        $existe = Alumno::where('run', $run)->exists();
        if ($existe) continue;

        DB::table('colegio20252')->insert([
    'Nombres' => $fila[0],
    'Apellido Paterno' => $fila[1],
    'Apellido Materno' => $fila[2],
    'Run' => $run,
    'Digito Ver' => $digito,
    'Desc Grado' => $fila[5],
]);
    }

    return redirect()->back()->with('success', 'Alumnos importados correctamente.');
}

}
