@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('utp.index') }}">UTP</a></li>
        <li class="breadcrumb-item active" aria-current="page">Planificaciones</li>
      </ol>
    </nav>
<h2 class="titulo-principal">📘 Planificaciones</h2>


   <div class="list-group"> 
    <a href="{{ route('planificaciones.basica') }}" class="list-group-item list-group-item-action"> 🏫 Primera Unidad - Educación Básica </a>
     <a href="{{ route('planificaciones.media') }}" class="list-group-item list-group-item-action"> 🎓 Primera Unidad - Educación Media </a> 
    </div>

    <!-- Botón Volver -->
    <a href="{{ route('utp.index') }}" class="btn btn-secondary mt-4">
        ⬅️ Volver a Unidad Técnico Pedagógica
    </a>
</div>
@endsection
