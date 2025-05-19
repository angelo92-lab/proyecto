@extends('layouts.app') {{-- Asegúrate de tener layouts.app configurado --}}

@section('content')
<div class="container">
    <h2>Importar Funcionarios desde CSV o Excel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ url('/importar-funcionarios') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="archivo" class="form-label">Selecciona el archivo (.csv o .xlsx)</label>
            <input type="file" name="archivo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Importar</button>
    </form>
</div>
@endsection
