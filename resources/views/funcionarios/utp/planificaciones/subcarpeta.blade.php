@extends('layouts.app')

@section('content')
<h2>📄 Archivos de {{ $subcarpeta }} en {{ $unidad }}</h2>
<ul>
    @foreach ($archivos as $archivo)
        <li>
            <a href="{{ asset('planificaciones/' . $unidad . '/' . $subcarpeta . '/' . $archivo->getFilename()) }}" target="_blank">
                {{ $archivo->getFilename() }}
            </a>
        </li>
    @endforeach
</ul>
<a href="{{ route('planificaciones.unidad', $unidad) }}" class="btn btn-secondary mt-3">⬅ Volver</a>
@endsection
