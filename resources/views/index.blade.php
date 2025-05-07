@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center bg-light">
    <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo Colegio" class="animate__animated animate__fadeInDown mb-4" style="width: 180px; height: auto;"/>
    <h1 class="display-4 fw-bold mb-3 text-primary">Colegio Republica De Chile</h1>
    <p class="lead mb-4 text-secondary" style="max-width: 600px;">
        Accede a todas las funcionalidades de gestión educativa desde esta plataforma sencilla y moderna.
    </p>
    <a href="{{ url('login') }}" class="btn btn-primary btn-lg shadow">
        Iniciar Sesión <i class="bi bi-box-arrow-in-right ms-2"></i>
    </a>
</div>
@endsection