@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📚 Unidad Técnica Pedagógica (UTP)</h1>

    <div class="list-group">
        <a href="{{ route('utp.formatos') }}" class="list-group-item list-group-item-action">
            📄 Formatos 
        </a>
        <a href="{{ route('utp.resultados') }}" class="list-group-item list-group-item-action">
            📊 Resultados de Evaluaciones
        </a>
        <a href="{{ route('utp.lineamientos') }}" class="list-group-item list-group-item-action">
            📘 Lineamientos
        </a>
        <a href="{{ route('planificaciones.index') }}" class="list-group-item list-group-item-action">
            📁 Planificaciones
        </a>
        <a href="{{ route('funcionarios.acompanamiento') }}" class="list-group-item list-group-item-action">
            📁 Acomapañamiento Docente
        </a>
    </div>
</div>
@endsection
