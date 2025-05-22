@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📘 Lineamientos Técnico-Pedagógicos</h1>

    <p>En este apartado se presentan los lineamientos definidos por la Unidad Técnica Pedagógica para el presente año.</p>

    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            📄 Cronograma Evaluacion 2025 (PDF)
            <a href="{{ asset('documentos/utp/cronograma evaluacion 2025.pdf') }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver PDF</a>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            📝 Pauta Acomapañamiento Al Aula 2025(Word)
            <a href="{{ asset('documentos/utp/pauta de acompañamiento al aula  2025.docx') }}" target="_blank" class="btn btn-sm btn-outline-success">Descargar Word</a>
        </li>
    </ul>
</div>
@endsection
