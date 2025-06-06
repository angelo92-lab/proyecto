@extends('layouts.app')

@section('content')
    <h2>📁 {{ $unidad }}</h2>
    <ul>
        @foreach ($subcarpetas as $sub)
            <li>
                <a href="{{ route('planificaciones.subcarpeta', [$unidad, $sub]) }}">{{ $sub }}</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('planificaciones.index') }}" class="btn btn-secondary mt-3">⬅ Volver</a>
@endsection
