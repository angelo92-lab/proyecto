@extends('layouts.app') {{-- Asegúrate de que tu layout principal se llama así --}}

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Información del Colegio</h1>

    <div class="mb-4">
        <h3>Misión</h3>
        <p>Formar estudiantes integrales, responsables y comprometidos con su comunidad.</p>
    </div>

    <div class="mb-4">
        <h3>Visión</h3>
        <p>Ser una institución educativa reconocida por su excelencia académica y humana.</p>
    </div>

    <div class="mb-4">
        <h3>Datos de contacto</h3>
        <ul>
            <li><strong>Dirección:</strong> Plaza de Armas N° 40,Monte Patria, Coquimbo</li>
            <li><strong>Teléfono:</strong> 9 9257 1268</li>
            <li><strong>Email:</strong> contacto@colegio.cl</li>
        </ul>
    </div>

    <div class="mb-4">
        <h3>Equipo Directivo</h3>
        <ul>
            <li><strong>Director:</strong> Carlos Cortes</li>
            <li><strong>Jefa UTP:</strong>######</li>
            <li><strong>Inspector General:</strong>#####</li>
        </ul>
    </div>

</div>
@endsection
