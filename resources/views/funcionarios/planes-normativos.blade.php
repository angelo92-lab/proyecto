@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📚 Planes Normativos</h1>

    <p>Aquí puedes revisar los planes, reglamentos y normativas institucionales del colegio.</p>

    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Proyecto Educativo Institucional (PEI)
            <a href="{{ asset('documentos/PEI.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Acta Capacitacion Resolucion 2024
            <a href="{{ asset('documentos/actacapacitacionconflicto20.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Acta Cuentas Financieras 2024
            <a href="{{ asset('documentos/actacuentasfinancieras2024.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Descargar</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Acta Primer Consejo 2025
            <a href="{{ asset('documentos/actaprimerconsejo2025.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Acta Resultados Academicos 2024
            <a href="{{ asset('documentos/actaresultadosacademicos2024.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
         <li class="list-group-item d-flex justify-content-between align-items-center">
            Identificacion Consejo 2025
            <a href="{{ asset('documentos/identificacionconsejo2025.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
           Encargada Convivencia
            <a href="{{ asset('documentos/nombramientoencargadaconvivencia.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
    </ul>
</div>
@endsection
