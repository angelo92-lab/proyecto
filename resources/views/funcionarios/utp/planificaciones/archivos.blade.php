@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">📁 {{ $subcarpeta ? $subcarpeta : $carpeta }}</h2>

    @if($subcarpetas->isNotEmpty())
        <h5 class="mb-2">📂 Subcarpetas</h5>
        <div class="list-group mb-4">
            @foreach ($subcarpetas as $sub)
                <a href="{{ route('planificaciones.archivos', [
                        'nivel' => $nivel,
                        'carpeta' => urlencode($carpeta),
                        'subcarpeta' => urlencode($sub)
                    ]) }}"
                   class="list-group-item list-group-item-action">
                    📁 {{ $sub }}
                </a>
            @endforeach
        </div>
    @endif

    @if($archivos->isNotEmpty())
        <h5 class="mb-2">📄 Archivos</h5>
        <ul class="list-group">
            @foreach ($archivos as $archivo)
                <li class="list-group-item">
                    <a href="{{ asset("planificaciones/$nivel/" . urlencode($carpeta) . ($subcarpeta ? '/' . urlencode($subcarpeta) : '') . '/' . urlencode($archivo)) }}"
                       target="_blank">
                        📄 {{ $archivo }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No hay archivos en esta carpeta.</p>
    @endif
</div>
@endsection
