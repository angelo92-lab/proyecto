<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}
