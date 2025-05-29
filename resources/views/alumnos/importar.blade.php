@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Importar alumnos desde Excel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('alumnos.importar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="archivo" class="form-label">Archivo Excel</label>
            <input type="file" name="archivo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</div>
@endsection
