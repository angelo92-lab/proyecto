@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Notas de Alumnos</h2>
    <p>Selecciona el nivel:</p>

    <div class="list-group">
        <a href="{{ route('notas.nt1') }}" class="btn btn-primary btn-lg mb-3">📚 NT1</a>
       <a href="{{ route('notas.nt1') }}" class="btn btn-primary btn-lg mb-3">📚 NT2</a>
        <a href="{{ route('notas.nt1') }}" class="btn btn-primary btn-lg mb-3">📚 Enseñanza Media</a>
    </div>
</div>
@endsection

