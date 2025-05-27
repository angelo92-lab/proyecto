@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-200">
        <div class="flex items-center justify-between px-6 py-4 bg-indigo-600 text-white">
            <h2 class="text-2xl font-bold">📘 Plan de Acompañamiento</h2>
            <a href="{{ asset('documentos/listadoplan.xlsx') }}" 
               class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 font-semibold rounded-md hover:bg-indigo-100 transition">
                📥 Descargar Excel
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                    <tr>
                        @foreach ($encabezados as $encabezado)
                            <th class="px-6 py-3 text-left font-semibold">
                                {{ $encabezado }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($filas as $fila)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-indigo-50 transition">
                            <td class="px-6 py-3">{{ $fila['nro'] }}</td>
                            <td class="px-6 py-3">{{ $fila['curso'] }}</td>
                            <td class="px-6 py-3">{{ $fila['nombre'] }}</td>
                            <td class="px-6 py-3">{{ $fila['procedencia'] }}</td>
                            <td class="px-6 py-3">{{ $fila['asignatura'] }}</td>
                            <td class="px-6 py-3">{{ $fila['asistencia'] }}</td>
                            <td class="px-6 py-3">{{ $fila['acompanamiento'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 text-right text-xs text-gray-500 bg-gray-50 border-t">
            Última actualización: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </div>
    </div>
</div>
@endsection
