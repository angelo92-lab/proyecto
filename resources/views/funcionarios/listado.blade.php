@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
        <div class="bg-indigo-600 px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Listado Estudiantes - 21 de Mayo</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-300 border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        @foreach ($encabezados as $encabezado)
                            <th class="px-4 py-3 border text-left text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                {{ $encabezado }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($filas as $fila)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 border">{{ $fila['nro'] }}</td>
                            <td class="px-4 py-3 border">{{ $fila['nombre'] }}</td>
                            <td class="px-4 py-3 border">{{ $fila['desfile'] }}</td>
                            <td class="px-4 py-3 border">{{ $fila['banda'] }}</td>
                            <td class="px-4 py-3 border">{{ $fila['lugar'] }}</td>
                            <td class="px-4 py-3 border">{{ $fila['asiste'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-4 text-gray-500">
                                No hay datos para mostrar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
