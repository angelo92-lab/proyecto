<!-- resources/views/plan/import.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Importar Plan de Acompañamiento</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('plan.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Selecciona un archivo Excel:</label>
            <input type="file" name="file" class="form-control" required accept=".xlsx,.xls,.csv">
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</div>
@endsection
