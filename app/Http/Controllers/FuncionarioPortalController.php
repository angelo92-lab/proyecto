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

}

