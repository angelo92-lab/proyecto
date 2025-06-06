@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📁 Planificaciones</h1>

    <div class="list-group">
        <a href="{{ route('planificaciones.basica') }}" class="list-group-item list-group-item-action">
            🏫 Primera Unidad - Educación Básica
        </a>
        <a href="{{ route('planificaciones.media') }}" class="list-group-item list-group-item-action">
            🎓 Primera Unidad - Educación Media
        </a>
    </div>
</div>
@endsection
