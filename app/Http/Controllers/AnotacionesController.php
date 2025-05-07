<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnotacionesController extends Controller
{
    public function index()
    {
        if (!session()->has('usuario_id')) {
            return redirect('login');
        }

        $anotaciones = DB::table('anotaciones as a')
            ->leftJoin('colegio20252 as al', 'a.rut', '=', 'al.run')
            ->select('al.nombres', 'al.apellido paterno', 'a.rut', 'a.anotacion', 'a.fecha')
            ->orderBy('a.fecha', 'DESC')
            ->get();

        return view('anotaciones', compact('anotaciones'));
    }
}