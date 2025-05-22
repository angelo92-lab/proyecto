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
    </div>
</div>
@endsection
