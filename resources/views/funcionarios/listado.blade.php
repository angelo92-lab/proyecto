@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <p style="color: red;">Vista cargada correctamente</p>
            <h2 class="text-2xl font-semibold text-gray-800">Listado Estudiantes 21 de Mayo</h2>

            <a href="{{ asset('documentos/listadodesfile.xlsx') }}" download
               class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Descargar Excel
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                <thead class="bg-gray-100">
                    <tr>
                        @foreach ($encabezados as $encabezado)
                            <th class="px-4 py-2 text-left font-semibold uppercase tracking-wide text-gray-700">
                                {{ $encabezado }}
                            </th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($filas as $fila)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="px-4 py-2">{{ $fila['nro'] }}</td>
                            <td class="px-4 py-2 text-red-500 font-bold">{{ $fila['nombre'] }}</td>

                            <td class="px-4 py-2">
                                @if(strtolower(trim($fila['desfile'])) === 'si')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Sí</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-200 rounded-full">No</span>
                                @endif
                            </td>

                            <td class="px-4 py-2">{{ $fila['banda'] }}</td>
                            <td class="px-4 py-2">{{ $fila['lugar'] }}</td>

                            <td class="px-4 py-2">
                                @if(strtolower(trim($fila['asiste'])) === 'si')
                                    <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">Sí</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">No</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
