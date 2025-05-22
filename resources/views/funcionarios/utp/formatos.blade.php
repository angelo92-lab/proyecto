@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📄 Formatos UTP</h1>

    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Ejemplo Tabla Espicifaciones 2025
            <a href="{{ asset('documentos/utp/EJEMPLO TABLA DE ESPECIFICACIONES 2025.docx') }}" target="_blank" class="btn btn-sm btn-outline-primary">Descargar</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Formato Evaluacion
            <a href="{{ asset('documentos/utp/FORMATO EVALUACION .docx') }}" target="_blank" class="btn btn-sm btn-outline-primary">Descargar</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Formato Planificacion Anual 2025
            <a href="{{ asset('documentos/utp/FORMATO PLANIFICACIÓN ANUAL 2025.docx') }}" target="_blank" class="btn btn-sm btn-outline-primary">Descargar</a>
        </li>
    </ul>
</div>
@endsection
