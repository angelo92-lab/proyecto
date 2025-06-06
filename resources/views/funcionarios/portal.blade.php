@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📚 Portal de Funcionarios</h2>
    <p class="text-center mb-5">Selecciona la sección a la que deseas acceder:</p>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @php
            $secciones = [
                ['route' => route('funcionarios.informacion'), 'icon' => '🧾', 'label' => 'Información del Colegio'],
                ['route' => route('notas.alumnos'), 'icon' => '📝', 'label' => 'Notas de Alumnos'],
                ['route' => '#', 'icon' => '📂', 'label' => 'Otros Documentos'],
                 ['route' => route('plan.acompanamiento'), 'icon' => '📘', 'label' => 'Planes de Acompañamiento'],
                ['route' => '#', 'icon' => '🧠', 'label' => 'Apoyo Psico Social'],
                ['route' => '#', 'icon' => '🎓', 'label' => 'Capacitaciones'],
                ['route' => route('funcionarios.encuestas'), 'icon' => '📊', 'label' => 'Encuestas'],
                ['route' => route('funcionarios.listado'), 'icon' => '📋', 'label' => 'Listados'],
                ['route' => '#', 'icon' => '💰', 'label' => 'Movimiento Financiero SEP'],
                ['route' => route('funcionarios.planes-normativos'), 'icon' => '🧾', 'label' => 'Planes Normativos'],
                ['route' => route('utp.index'), 'icon' => '🧑‍🏫', 'label' => 'Unidad Técnica Pedagógica']
            ];
        @endphp

        @foreach ($secciones as $seccion)   
            <div class="col">
                <a href="{{ $seccion['route'] }}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0 text-center">
                        <div class="card-body">
                            <div class="display-4 mb-3">{{ $seccion['icon'] }}</div>
                            <h5 class="card-title">{{ $seccion['label'] }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
            