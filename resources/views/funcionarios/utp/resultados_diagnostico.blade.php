@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-2xl font-bold">
        <i class="bi bi-journal-text me-2"></i> Resultados DIA - Diagnóstico 2025
    </h1>

    <p class="mb-4">
        Aquí encontrarás los resultados generales y por curso, actualizados automáticamente según los archivos disponibles.
    </p>

    {{-- Archivos generales --}}
    <h4 class="text-lg font-semibold">
        <i class="bi bi-file-earmark-text me-1"></i> Archivos Generales
    </h4>
    @if($archivosGenerales->isEmpty())
        <p class="text-muted">No hay archivos generales disponibles.</p>
    @else
        <ul class="list-group mb-4">
            @foreach ($archivosGenerales as $archivo)
                @php
                    $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                    $icono = match(strtolower($ext)) {
                        'pdf' => 'bi-file-earmark-pdf text-danger',
                        'doc', 'docx' => 'bi-file-earmark-word text-primary',
                        'xls', 'xlsx' => 'bi-file-earmark-excel text-success',
                        'ppt', 'pptx' => 'bi-file-earmark-slides text-warning',
                        'zip', 'rar' => 'bi-file-earmark-zip',
                        'jpg', 'jpeg', 'png', 'gif' => 'bi-file-earmark-image text-info',
                        default => 'bi-file-earmark'
                    };
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <i class="bi {{ $icono }} me-2"></i> {{ $archivo }}
                    <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $archivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Carpetas por curso --}}
    <h3 class="text-xl font-semibold mt-6 mb-2">
        <i class="bi bi-folder2-open me-2"></i> Carpetas por Curso
    </h3>
    @if(count($carpetas) > 0)
        <div class="space-y-4">
            @foreach($carpetas as $carpeta)
                <div class="border p-4 rounded shadow-sm mb-4">
                    <h4 class="text-lg font-bold text-gray-800">
                        <i class="bi bi-folder-fill me-2 text-warning"></i> {{ $carpeta['nombre'] }}
                    </h4>

                    {{-- Archivos sueltos --}}
                    @if(count($carpeta['archivos']) > 0)
                        <ul class="list-disc ml-5 mt-2 space-y-1">
                            @foreach($carpeta['archivos'] as $archivo)
                                @php
                                    $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                                    $icono = match(strtolower($ext)) {
                                        'pdf' => 'bi-file-earmark-pdf text-danger',
                                        'doc', 'docx' => 'bi-file-earmark-word text-primary',
                                        'xls', 'xlsx' => 'bi-file-earmark-excel text-success',
                                        'ppt', 'pptx' => 'bi-file-earmark-slides text-warning',
                                        'zip', 'rar' => 'bi-file-earmark-zip',
                                        'jpg', 'jpeg', 'png', 'gif' => 'bi-file-earmark-image text-info',
                                        default => 'bi-file-earmark'
                                    };
                                @endphp
                                <li>
                                    <i class="bi {{ $icono }} me-2"></i>
                                    <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $carpeta['nombre'] . '/' . $archivo) }}"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">
                                        {{ $archivo }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-500 mt-1">Esta carpeta no tiene archivos sueltos.</p>
                    @endif

                    {{-- Subcarpetas colapsables --}}
                    @if(count($carpeta['subcarpetas']) > 0)
                        <div class="mt-4">
                            <h5 class="font-semibold">
                                <i class="bi bi-folder-symlink me-1"></i> Subcarpetas
                            </h5>
                            @foreach($carpeta['subcarpetas'] as $index => $sub)
                                <div class="accordion" id="accordion-{{ $carpeta['nombre'] }}">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading-{{ $carpeta['nombre'] }}-{{ $index }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $carpeta['nombre'] }}-{{ $index }}" aria-expanded="false" aria-controls="collapse-{{ $carpeta['nombre'] }}-{{ $index }}">
                                                <i class="bi bi-folder2 me-2 text-warning"></i> {{ $sub['nombre'] }}
                                            </button>
                                        </h2>
                                        <div id="collapse-{{ $carpeta['nombre'] }}-{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $carpeta['nombre'] }}-{{ $index }}" data-bs-parent="#accordion-{{ $carpeta['nombre'] }}">
                                            <div class="accordion-body">
                                                <ul class="list-disc ml-4">
                                                    @foreach($sub['archivos'] as $archivo)
                                                        @php
                                                            $ext = pathinfo($archivo, PATHINFO_EXTENSION);
                                                            $icono = match(strtolower($ext)) {
                                                                'pdf' => 'bi-file-earmark-pdf text-danger',
                                                                'doc', 'docx' => 'bi-file-earmark-word text-primary',
                                                                'xls', 'xlsx' => 'bi-file-earmark-excel text-success',
                                                                'ppt', 'pptx' => 'bi-file-earmark-slides text-warning',
                                                                'zip', 'rar' => 'bi-file-earmark-zip',
                                                                'jpg', 'jpeg', 'png', 'gif' => 'bi-file-earmark-image text-info',
                                                                default => 'bi-file-earmark'
                                                            };
                                                        @endphp
                                                        <li>
                                                            <i class="bi {{ $icono }} me-2"></i>
                                                            <a href="{{ asset('documentos/utp/resultados_diagnostico/' . $carpeta['nombre'] . '/' . $sub['nombre'] . '/' . $archivo) }}"
                                                               target="_blank"
                                                               class="text-blue-600 hover:underline">
                                                                {{ $archivo }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
