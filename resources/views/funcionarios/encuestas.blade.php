@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Encuestas</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">📝 Encuesta de Satisfacción Docente</h5>
            <p class="card-text">Tu opinión es muy importante para nosotros. Por favor, responde esta breve encuesta para ayudarnos a mejorar.</p>
            <a href="https://docs.google.com/forms/d/1YnvW5o8uDFH2SUt8LGRT6yIwVf95-6jQpoKfB-tm17c/edit" target="_blank" class="btn btn-primary">
                Responder Encuesta
            </a>
        </div>
    </div>

    {{-- Puedes duplicar esta tarjeta para más encuestas --}}
</div>
@endsection
