@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Importar notas desde Excel</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('notas.importar.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold mb-1" for="archivo">Archivo Excel (.xlsx o .xls)</label>
            <input type="file" name="archivo" id="archivo" required class="border rounded p-2 w-full">
            @error('archivo')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Subir y procesar</button>
    </form>
</div>
@endsection
