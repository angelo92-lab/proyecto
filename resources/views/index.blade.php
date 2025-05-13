@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center vh-100 text-center bg-light position-relative overflow-hidden">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(102, 166, 255, 0.1), transparent); z-index: 0;"></div>

    <div class="z-1">
        <img src="{{ asset('imagenes/logo.jpg') }}" alt="Logo Colegio" class="animate__animated animate__fadeInDown mb-4" style="width: 180px; height: auto;"/>
        <h1 class="display-4 fw-bold mb-3 text-primary">Colegio República de Chile</h1>
        <p class="lead mb-4 text-secondary" style="max-width: 620px;">
            Accede a todas las funcionalidades de gestión educativa desde esta plataforma sencilla, moderna y segura.
        </p>
        <a href="{{ url('login') }}" class="btn btn-primary btn-lg px-4 py-2 shadow-sm">
            Iniciar Sesión <i class="bi bi-box-arrow-in-right ms-2"></i>
        </a>
    </div>
</div>
@endsection
