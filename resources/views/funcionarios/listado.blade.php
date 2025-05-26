@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <h2 class="text-2xl font-semibold text-gray-800">Listado Estudiantes 21 de Mayo</h2>

            <a href="{{ asset('documentos/listadodesfile.xlsx') }}" download
               class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                Descargar Excel
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        @foreach ($encabezados as $encabezado)
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                {{ $encabezado }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                 @foreach ($filas as $fila)
                     <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                     <td class="px-4 py-2">{{ $fila['nro'] }}</td>
                    <td class="px-4 py-2">{{ $fila['nombre'] }}</td>
                    <td class="px-4 py-2">{{ $fila['desfile'] }}</td>
                    <td class="px-4 py-2">{{ $fila['banda'] }}</td>
                    <td class="px-4 py-2">{{ $fila['lugar'] }}</td>
                    <td class="px-4 py-2">{{ $fila['asiste'] }}</td>
                     </tr>
                 @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
