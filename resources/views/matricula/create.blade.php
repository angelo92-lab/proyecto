@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulario de Matrícula 2026</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('matricula.store') }}" method="POST">
        @csrf

        {{-- DATOS DEL ESTUDIANTE --}}
        <h4>Datos del Estudiante</h4>
        <div class="form-group">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control" value="{{ old('nombres') }}">
        </div>
        <div class="form-group">
            <label>Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno') }}">
        </div>
        <div class="form-group">
            <label>Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno') }}">
        </div>
        <div class="form-group">
            <label>RUN</label>
            <input type="text" name="run" class="form-control" value="{{ old('run') }}">
        </div>
        <div class="form-group">
            <label>Curso</label>
            <input type="text" name="curso" class="form-control" value="{{ old('curso') }}">
        </div>
        <div class="form-group">
            <label>Edad</label>
            <input type="number" name="edad" class="form-control" value="{{ old('edad') }}">
        </div>
        <div class="form-group">
            <label>Sexo</label>
            <select name="sexo" class="form-control">
                <option value="">Seleccione</option>
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>

        <hr>

        {{-- PADRE --}}
        <h4>Información del Padre</h4>
        <div class="form-group">
            <label>Nombre del Padre</label>
            <input type="text" name="nombre_padre" class="form-control" value="{{ old('nombre_padre') }}">
        </div>
        <div class="form-group">
            <label>Teléfono del Padre</label>
            <input type="text" name="telefono_padre" class="form-control" value="{{ old('telefono_padre') }}">
        </div>

        <hr>

        {{-- MADRE --}}
        <h4>Información de la Madre</h4>
        <div class="form-group">
            <label>Nombre de la Madre</label>
            <input type="text" name="nombre_madre" class="form-control" value="{{ old('nombre_madre') }}">
        </div>
        <div class="form-group">
            <label>Teléfono de la Madre</label>
            <input type="text" name="telefono_madre" class="form-control" value="{{ old('telefono_madre') }}">
        </div>

        <hr>

        {{-- TUTOR LEGAL --}}
        <h4>Tutor Legal</h4>
        <div class="form-group">
            <label>Nombre del Tutor</label>
            <input type="text" name="nombre_tutor" class="form-control" value="{{ old('nombre_tutor') }}">
        </div>
        <div class="form-group">
            <label>Parentesco</label>
            <input type="text" name="parentesco_tutor" class="form-control" value="{{ old('parentesco_tutor') }}">
        </div>

        <hr>

        {{-- VIVIENDA --}}
        <h4>Información de Vivienda</h4>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
        </div>
        <div class="form-group">
            <label>Tipo de Vivienda</label>
            <input type="text" name="tipo_vivienda" class="form-control" value="{{ old('tipo_vivienda') }}">
        </div>

        <hr>

        {{-- APODERADO --}}
        <h4>Apoderado</h4>
        <div class="form-group">
            <label>Nombre del Apoderado</label>
            <input type="text" name="nombre_apoderado" class="form-control" value="{{ old('nombre_apoderado') }}">
        </div>
        <div class="form-group">
            <label>RUN del Apoderado</label>
            <input type="text" name="run_apoderado" class="form-control" value="{{ old('run_apoderado') }}">
        </div>
        <div class="form-group">
            <label>Teléfono del Apoderado</label>
            <input type="text" name="telefono_apoderado" class="form-control" value="{{ old('telefono_apoderado') }}">
        </div>

        <hr>

        {{-- CONTACTO DE EMERGENCIA --}}
        <h4>Contactos de Emergencia</h4>
        <div class="form-group">
            <label>Nombre Contacto 1</label>
            <input type="text" name="nombre_contacto1" class="form-control" value="{{ old('nombre_contacto1') }}">
        </div>
        <div class="form-group">
            <label>Teléfono Contacto 1</label>
            <input type="text" name="telefono_contacto1" class="form-control" value="{{ old('telefono_contacto1') }}">
        </div>
        <div class="form-group">
            <label>Nombre Contacto 2</label>
            <input type="text" name="nombre_contacto2" class="form-control" value="{{ old('nombre_contacto2') }}">
        </div>
        <div class="form-group">
            <label>Teléfono Contacto 2</label>
            <input type="text" name="telefono_contacto2" class="form-control" value="{{ old('telefono_contacto2') }}">
        </div>

        <hr>

        {{-- RESPONSABLE DEL LLENADO --}}
        <h4>Responsable del Llenado</h4>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="responsable_nombre" class="form-control" value="{{ old('responsable_nombre') }}">
        </div>
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha_llenado" class="form-control" value="{{ old('fecha_llenado', date('Y-m-d')) }}">
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Guardar Matrícula</button>
    </form>
</div>
@endsection
