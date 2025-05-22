@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📘 Resultados DIA - Diagnóstico 2025</h1>

    <p class="mb-4">En esta sección se encuentran los resultados por curso y archivos generales. Las carpetas de cursos están habilitadas para futuras actualizaciones.</p>

    <h4 class="mt-4">📄 Archivos Generales</h4>
    <ul class="list-group mb-4">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            📄 Informe Establecimiento Diagnostico 2025
            <a href="{{ asset('documentos/utp/informeEstablecimiento799_diagnostico_2025.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            📄 Informe Ficha Sintesis Diagnostico Reactivacion Lectura 2025
            <a href="{{ asset('documentos/utp/informeEstablecimiento799_FICHA_SINTESIS_diagnostico_para_la_reactivacion_de_la_lectura_2025.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
        </li>
    </ul>

    <h4 class="mt-4">📁 Carpetas de Cursos</h4>
    <div class="row row-cols-1 row-cols-md-2 g-3">
        @php
            $carpetas = [
                '1 Medio A',
                '1 Medio B',
                '2 Básico',
                '2 Medio A',
                '2 Medio B',
                '3 Básico',
                '4 Básico',
                '5 Básico',
                '6 Básico',
                '7 Básico A',
                '7 Básico B',
                '8 Básico A',
                '8 Básico B',
            ];
        @endphp

        @foreach ($carpetas as $nombre)
        <div class="col">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">📁 {{ $nombre }}</h5>
                    <p class="text-muted mb-0">Sin archivos por ahora</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
