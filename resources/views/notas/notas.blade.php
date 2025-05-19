@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📘 Portal de Notas de Alumnos</h2>
    <p>Selecciona un ciclo y curso para ver las notas:</p>

    <!-- PRIMER CICLO -->
    <div class="mb-4">
        <h4>🎒 Primer Ciclo (1º a 4º Básico)</h4>
        <div class="btn-group flex-wrap" role="group">
            <a href="#" class="btn btn-outline-primary mb-2">1º Básico</a>
            <a href="#" class="btn btn-outline-primary mb-2">2º Básico</a>
            <a href="#" class="btn btn-outline-primary mb-2">3º Básico</a>
            <a href="#" class="btn btn-outline-primary mb-2">4º Básico</a>
        </div>
    </div>

    <!-- SEGUNDO CICLO -->
    <div class="mb-4">
        <h4>🎒 Segundo Ciclo (5º a 8º Básico)</h4>
        <div class="btn-group flex-wrap" role="group">
            <a href="#" class="btn btn-outline-success mb-2">5º Básico</a>
            <a href="#" class="btn btn-outline-success mb-2">6º Básico</a>
            <a href="#" class="btn btn-outline-success mb-2">7º Básico A</a>
            <a href="#" class="btn btn-outline-success mb-2">7º Básico B</a>
            <a href="#" class="btn btn-outline-success mb-2">8º Básico A</a>
            <a href="#" class="btn btn-outline-success mb-2">8º Básico B</a>
        </div>
    </div>

    <!-- ENSEÑANZA MEDIA -->
    <div class="mb-4">
        <h4>🎓 Enseñanza Media</h4>
        <div class="btn-group flex-wrap" role="group">
            <a href="#" class="btn btn-outline-dark mb-2">1º Medio A</a>
            <a href="#" class="btn btn-outline-dark mb-2">1º Medio B</a>
            <a href="#" class="btn btn-outline-dark mb-2">2º Medio A</a>
            <a href="#" class="btn btn-outline-dark mb-2">2º Medio B</a>
            <a href="#" class="btn btn-outline-dark mb-2">3º Medio A</a>
            <a href="#" class="btn btn-outline-dark mb-2">3º Medio B</a>
            <a href="#" class="btn btn-outline-dark mb-2">4º Medio A</a>
            <a href="#" class="btn btn-outline-dark mb-2">4º Medio B</a>
        </div>
    </div>

    <!-- EDUCACIÓN ADULTOS -->
    <div class="mb-4">
        <h4>🌙 Educación de Adultos (Vespertino)</h4>
        <div class="btn-group flex-wrap" role="group">
            <a href="#" class="btn btn-outline-secondary mb-2">Nivel 1</a>
            <a href="#" class="btn btn-outline-secondary mb-2">Nivel 2</a>
        </div>
    </div>
</div>
@endsection
