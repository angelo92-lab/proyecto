<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcarAlmuerzoController extends Controller
{
    public function index()
    {
        if (!session()->has('usuario_id')) {
            return redirect('login');
        }

        return view('marcaralmuerzo', ['mensaje' => '']);
    }

    public function store(Request $request)
    {
        if (!session()->has('usuario_id')) {
            return redirect('login');
        }

        $rut = $request->input('rut', '');

        if ($rut) {
            $alumno = DB::table('colegio20252')->where('Run', $rut)->first();

            if ($alumno) {
                $fechaHoy = date('Y-m-d');
                $registro = DB::table('almuerzos')->where('rut_alumno', $rut)->where('fecha', $fechaHoy)->first();

                if ($registro) {
                    $mensaje = "El alumno {$alumno->Nombres} ya fue marcado como almorzó hoy.";
                } else {
                    DB::table('almuerzos')->insert([
                        'rut_alumno' => $rut,
                        'fecha' => $fechaHoy,
                        'almorzo' => 1,
                    ]);
                    $mensaje = "Se ha marcado que el alumno {$alumno->Nombres} almorzó hoy.";
                }
            } else {
                $mensaje = "No se encontró ningún alumno con ese RUT.";
            }
        } else {
            $mensaje = "Por favor ingrese un RUT válido.";
        }

        return view('marcaralmuerzo', ['mensaje' => $mensaje]);
    }

    // Nueva función para marcar almuerzo desde la máquina lectora
    public function marcar(Request $request)
    {
        $rut = $request->input('rut');

        if (!$rut) {
            return response()->json(['error' => 'RUT no proporcionado'], 400);
        }

        $alumno = DB::table('colegio20252')->where('Run', $rut)->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        $fechaHoy = date('Y-m-d');

        $registro = DB::table('almuerzos')
            ->where('rut_alumno', $rut)
            ->where('fecha', $fechaHoy)
            ->first();

        if ($registro) {
            return response()->json(['message' => 'Alumno ya marcado como almorzó hoy'], 200);
        }

        DB::table('almuerzos')->insert([
            'rut_alumno' => $rut,
            'fecha' => $fechaHoy,
            'almorzo' => 1,
        ]);

        return response()->json(['message' => 'Alumno marcado como almorzó exitosamente'], 200);
    }
}