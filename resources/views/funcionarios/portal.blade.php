@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Portal de Funcionarios</h2>

    <p>Selecciona la sección a la que deseas acceder:</p>

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">
            🧾 Información del Colegio
        </a>
        <a href="{{ route('notas.alumnos') }}" class="list-group-item list-group-item-action">
            📝 Notas de Alumnos
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            📂 Otros Documentos
        </a>
        <a href="{{ route('funcionarios.planes') }}" class="list-group-item list-group-item-action">
            📘 Planes de Acompañamiento
        </a>
    </div>
</div>
@endsection
