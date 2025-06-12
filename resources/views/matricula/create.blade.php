@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formulario de Matrícula 2026</h2>

    <form action="{{ route('matricula.store') }}" method="POST">
        @csrf

        {{-- DATOS DEL ESTUDIANTE --}}
        <h4 class="mt-4">Datos del Estudiante</h4>
        <div class="row mb-3">
            <div class="col">
                <label>RUN</label>
                <input type="text" name="run" class="form-control" value="{{ old('run', $alumno->run ?? '') }}" required>
            </div>
            <div class="col">
                <label>Dígito Verificador</label>
                <input type="text" name="dv" class="form-control" value="{{ old('dv', $alumno->dv ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Nombres</label>
                <input type="text" name="nombres" class="form-control" value="{{ old('nombres', $alumno->nombres ?? '') }}" required>
            </div>
            <div class="col">
                <label>Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', $alumno->apellido_paterno ?? '') }}" required>
            </div>
            <div class="col">
                <label>Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', $alumno->apellido_materno ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Sexo</label>
                <select name="sexo" class="form-select">
                    <option value="">Seleccionar</option>
                    <option value="Masculino" {{ old('sexo', $alumno->sexo ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="Femenino" {{ old('sexo', $alumno->sexo ?? '') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>
            <div class="col">
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento ?? '') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $alumno->direccion ?? '') }}">
            </div>
            <div class="col">
                <label>Localidad</label>
                <input type="text" name="localidad" class="form-control" value="{{ old('localidad', $alumno->localidad ?? '') }}">
            </div>
            <div class="col">
                <label>Comuna</label>
                <input type="text" name="comuna" class="form-control" value="{{ old('comuna', $alumno->comuna ?? '') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Establecimiento de Procedencia</label>
            <input type="text" name="establecimiento_procedencia" class="form-control" value="{{ old('establecimiento_procedencia', $alumno->establecimiento_procedencia ?? '') }}">
        </div>

        {{-- MADRE --}}
        <h4 class="mt-4">Datos de la Madre</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Nombre Madre</label>
                <input type="text" name="madre_nombre" class="form-control" value="{{ old('madre_nombre') }}">
            </div>
            <div class="col">
                <label>RUN Madre</label>
                <input type="text" name="madre_run" class="form-control" value="{{ old('madre_run') }}">
            </div>
        </div>

        {{-- PADRE --}}
        <h4 class="mt-4">Datos del Padre</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Nombre Padre</label>
                <input type="text" name="padre_nombre" class="form-control" value="{{ old('padre_nombre') }}">
            </div>
            <div class="col">
                <label>RUN Padre</label>
                <input type="text" name="padre_run" class="form-control" value="{{ old('padre_run') }}">
            </div>
        </div>

        {{-- TUTOR LEGAL --}}
        <h4 class="mt-4">Datos del Tutor Legal</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Nombre Tutor</label>
                <input type="text" name="tutor_nombre" class="form-control" value="{{ old('tutor_nombre') }}">
            </div>
            <div class="col">
                <label>RUN Tutor</label>
                <input type="text" name="tutor_run" class="form-control" value="{{ old('tutor_run') }}">
            </div>
        </div>

        {{-- CON QUIÉN VIVE --}}
        <h4 class="mt-4">¿Con Quién Vive el Estudiante?</h4>
        <div class="mb-3">
            <input type="text" name="con_quien_vive" class="form-control" value="{{ old('con_quien_vive') }}">
        </div>

        {{-- VIVIENDA --}}
        <h4 class="mt-4">Información de Vivienda</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Tipo de Vivienda</label>
                <input type="text" name="tipo_vivienda" class="form-control" value="{{ old('tipo_vivienda') }}">
            </div>
            <div class="col">
                <label>Tenencia</label>
                <select name="tenencia" class="form-select">
                    <option value="">Seleccionar</option>
                    <option value="Propia" {{ old('tenencia') == 'Propia' ? 'selected' : '' }}>Propia</option>
                    <option value="Arrendada" {{ old('tenencia') == 'Arrendada' ? 'selected' : '' }}>Arrendada</option>
                    <option value="Usufructo" {{ old('tenencia') == 'Usufructo' ? 'selected' : '' }}>Usufructo</option>
                </select>
            </div>
        </div>

        {{-- APODERADO --}}
        <h4 class="mt-4">Datos del Apoderado</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Nombre Apoderado</label>
                <input type="text" name="apoderado_nombre" class="form-control" value="{{ old('apoderado_nombre') }}">
            </div>
            <div class="col">
                <label>RUN Apoderado</label>
                <input type="text" name="apoderado_run" class="form-control" value="{{ old('apoderado_run') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Parentesco</label>
            <input type="text" name="apoderado_parentesco" class="form-control" value="{{ old('apoderado_parentesco') }}">
        </div>

        {{-- CONTACTOS DE EMERGENCIA --}}
        <h4 class="mt-4">Contactos de Emergencia</h4>
        <div class="row mb-3">
            <div class="col">
                <label>Nombre Contacto 1</label>
                <input type="text" name="contacto1_nombre" class="form-control" value="{{ old('contacto1_nombre') }}">
            </div>
            <div class="col">
                <label>Teléfono Contacto 1</label>
                <input type="text" name="contacto1_telefono" class="form-control" value="{{ old('contacto1_telefono') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label>Nombre Contacto 2</label>
                <input type="text" name="contacto2_nombre" class="form-control" value="{{ old('contacto2_nombre') }}">
            </div>
            <div class="col">
                <label>Teléfono Contacto 2</label>
                <input type="text" name="contacto2_telefono" class="form-control" value="{{ old('contacto2_telefono') }}">
            </div>
        </div>

        {{-- RESPONSABLE DEL LLENADO --}}
        <h4 class="mt-4">Responsable del Llenado</h4>
        <div class="mb-3">
            <label>Nombre Responsable</label>
            <input type="text" name="responsable_nombre" class="form-control" value="{{ old('responsable_nombre') }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Guardar Matrícula</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
