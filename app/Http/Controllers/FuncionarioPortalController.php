<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioPortalController extends Controller
{
    public function index()
    {
        return view('funcionarios.portal');
    }

    public function verNotas()
{
    return view('funcionarios.notas');
}

public function notasNT1()
{
    return view('funcionarios.notas_nt1');
}

public function notasNT2()
{
    return view('funcionarios.notas_nt2');
}

public function notasMedia()
{
    return view('funcionarios.notas_media');
}


}

