@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Notas de Alumnos</h2>

    <p>Selecciona el nivel para ver las notas:</p>

    <ul class="list-group">
        <li class="list-group-item">📚 NT1 - Ver notas</li>
        <li class="list-group-item">📚 NT2 - Ver notas</li>
        <li class="list-group-item">🎓 Enseñanza Media - Ver notas</li>
    </ul>

    <p class="mt-4">Aquí más adelante podrás consultar y filtrar las notas por alumno, curso o asignatura.</p>
</div>
@endsection
