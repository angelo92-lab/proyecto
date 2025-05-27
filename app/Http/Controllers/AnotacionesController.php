<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnotacionesController extends Controller
{
    public function __construct()
    {
        // Aplica el middleware de autenticación a todas las rutas del controlador
        $this->middleware('auth');
    }

    public function index()
    {
        $anotaciones = DB::table('anotaciones as a')
            ->leftJoin('colegio20252 as al', 'a.rut', '=', 'al.run')
            ->select('al.nombres', 'al.apellido paterno', 'a.rut', 'a.anotacion', 'a.fecha')
            ->orderBy('a.fecha', 'DESC')
            ->get();

        return view('Anotaciones', compact('anotaciones'));
    }
    public function destroy($id)
{
    DB::table('anotaciones')->where('id', $id)->delete();

    return redirect()->route('anotaciones.index')->with('success', 'Anotación eliminada correctamente.');
}

}
