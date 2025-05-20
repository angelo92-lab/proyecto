<?php

use App\Models\PlanAcompanamiento;
use App\Imports\PlanAcompanamientoImport;
use Maatwebsite\Excel\Facades\Excel;

class PlanAcompanamientoController extends Controller
{
    public function index()
    {
        $planes = PlanAcompanamiento::all();
        return view('funcionarios.planes', compact('planes'));
    }

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,csv,xls',
    ]);

    Excel::import(new PlanAcompanamientoImport, $request->file('file'));

    return back()->with('success', 'Archivo importado correctamente.');
}

}
