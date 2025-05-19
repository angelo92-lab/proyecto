@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Notas - Enseñanza Media</h2>
    <p>Diseño o contenido de Enseñanza Media aquí...</p>

    <a href="{{ route('notas.alumnos') }}" class="btn btn-secondary mt-3">⬅️ Volver</a>
</div>
@endsection
