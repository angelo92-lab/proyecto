@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="titulo-principal">📊 Resultados de Evaluaciones</h1>


    <div class="list-group">
        <a href="{{ route('utp.resultados.diagnostico') }}" class="list-group-item list-group-item-action">
            📘 Resultados DIA - Diagnóstico 2025
        </a>
        <a href="{{ route('utp.resultados.parvularia') }}" class="list-group-item list-group-item-action">
            🧸 Resultados DIA - Inicial Educación Parvularia 2025
        </a>
    </div>
</div>
@endsection
