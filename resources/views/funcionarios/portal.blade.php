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
        <a href="#" class="list-group-item list-group-item-action">
            📘 Planes de Acompañamiento
        </a>

        {{-- Nuevas secciones --}}
        <a href="#" class="list-group-item list-group-item-action">
            🧠 Apoyo Psico Social
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            🎓 Capacitaciones
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            📊 Encuestas
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            📋 Listados
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            💰 Movimiento Financiero SEP
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            🧾 Planes Normativos
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            🧑‍🏫 Unidad Técnica Pedagógica
        </a>
    </div>
</div>
@endsection
