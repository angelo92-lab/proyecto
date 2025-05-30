@extends('layouts.app')

@section('title', 'Ingresar Matrícula')

@section('content')
<h1 class="text-center mb-4 text-primary fw-bold">📋 Ingreso de Matrícula 2026</h1>

@if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('matricula.store') }}" method="POST" class="shadow p-4 bg-white rounded">
    @csrf

    {{-- 1. Datos del Estudiante --}}
    <h4 class="mb-3 text-success">1️⃣ Datos del Estudiante</h4>
    <div class="row g-3">
        <div class="mb-3">
            <label for="curso" class="form-label">Curso al que se matricula</label>
            <select name="curso" id="curso" class="form-select" required>
                <option value="">Seleccionar curso</option>
                @foreach ([
                    'Pre-Kínder', 'Kínder', '1° Básico', '2° Básico', '3° Básico',
                    '4° Básico', '5° Básico', '6° Básico', '7° Básico A', '7° Básico B',
                    '8° Básico A', '8° Básico B', '1° Medio A', '1° Medio B',
                    '2° Medio A', '2° Medio B', '3° Medio A', '3° Medio B', '4° Medio A'
                ] as $curso)
                    <option value="{{ $curso }}">{{ $curso }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="rut" class="form-label">RUT</label>
            <input type="text" name="rut" id="rut" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="edad_2026" class="form-label">Edad al 31 de Marzo 2026</label>
            <input type="number" name="edad_al_31_marzo" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" name="nacionalidad" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="localidad" class="form-label">Localidad</label>
            <input type="text" name="localidad" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="comuna" class="form-label">Comuna</label>
            <input type="text" name="comuna" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Requiere locomoción municipal?</label>
            <select name="requiere_locomocion" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Pertenece a pueblos originarios?</label>
            <select name="pueblos_originarios" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="pueblo_especifico" class="form-label">¿Cuál?</label>
            <input type="text" name="pueblo_originario" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Programa de integración?</label>
           <select name="programa_integracion" class="form-control">
    <option value="1">Sí</option>
    <option value="0">No</option>
</select>
        </div>

        <div class="col-md-4">
            <label for="cursos_repetidos" class="form-label">Cursos repetidos</label>
            <input type="text" name="cursos_repetidos" class="form-control">
        </div>

        <div class="col-md-4">
            <label for="establecimiento_procedencia" class="form-label">Establecimiento de procedencia</label>
            <input type="text" name="establecimiento_procedencia" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">¿Alérgico a medicamentos o alimentos?</label>
            <select name="alergias" class="form-select">
                <option value="">Seleccionar</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="enfermedades" class="form-label">¿Padece alguna enfermedad diagnosticada?</label>
            <input type="text" name="enfermedad_diagnosticada" class="form-control">
        </div>
    </div>

    {{-- 2. Información Familiar --}}
    <h4 class="mt-4">👨‍👩‍👧 Padres y Tutor Legal</h4>

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Padre</label>
            <input type="text" name="padre_nombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-4">
            <label class="form-label">Nivel Educacional</label>
            <input type="text" name="padre_nivel_educacional" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Madre</label>
            <input type="text" name="madre_nombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="col-md-4">
            <label class="form-label">Nivel Educacional</label>
            <input type="text" name="madre_nivel_educacional" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">Tutor Legal</label>
            <input type="text" name="tutor_nombre" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Nivel Educacional</label>
            <input type="text" name="tutor_nivel_educacional" class="form-control">
        </div>

        <div class="col-12">
            <label class="form-label">¿Con quién vive el estudiante?</label>
            <textarea name="personas_con_quien_vive" class="form-control" rows="2"></textarea>
        </div>
    </div>

    {{-- 3. Vivienda --}}
    <h4 class="mt-4">🏠 Información de la Vivienda</h4>

    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">La vivienda es</label>
            <select name="tipo_vivienda" class="form-select">
                <option value="">Seleccionar</option>
                <option value="propia">Propia</option>
                <option value="cedida">Cedida</option>
                <option value="arrendada">Arrendada</option>
            </select>
        </div>
        <div class="col-md-4 form-check mt-4">
            <input class="form-check-input" type="checkbox" name="posee_luz" value="1" id="posee_luz">
            <label class="form-check-label" for="posee_luz">¿Posee luz?</label>
        </div>
        <div class="col-md-4 form-check mt-4">
            <input class="form-check-input" type="checkbox" name="posee_alcantarillado" value="1" id="posee_alcantarillado">
            <label class="form-check-label" for="posee_alcantarillado">¿Posee alcantarillado?</label>
        </div>
    </div>

    {{-- 4. Apoderado --}}
    <h4 class="mt-4">👨‍👩‍👧 Apoderado Titular y Suplente</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Apoderado Titular</label>
            <input type="text" name="apoderado_nombre" class="form-control" placeholder="Nombre completo">
            <input type="text" name="apoderado_domicilio" class="form-control mt-2" placeholder="Domicilio">
            <input type="text" name="apoderado_telefono" class="form-control mt-2" placeholder="Teléfono">
        </div>
        <div class="col-md-6">
            <label class="form-label">Apoderado Suplente</label>
            <input type="text" name="suplente_nombre" class="form-control" placeholder="Nombre completo">
            <input type="text" name="suplente_domicilio" class="form-control mt-2" placeholder="Domicilio">
            <input type="text" name="suplente_telefono" class="form-control mt-2" placeholder="Teléfono">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="autoriza_suplente" value="1">
                <label class="form-check-label">¿Autoriza al suplente a retirar?</label>
            </div>
        </div>
    </div>

    {{-- 5. Emergencia y Ficha --}}
    <h4 class="mt-4 text-primary fw-bold">📞 Contacto de Emergencia</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="emergencia_nombre" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Celular</label>
            <input type="text" name="emergencia_celular" class="form-control">
        </div>
    </div>

    <h4 class="mt-4 text-primary fw-bold">🖋️ Responsable de la Ficha</h4>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre</label>
            <input type="text" name="responsable_ficha" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Firma</label>
            <input type="text" name="firma_responsable" class="form-control" placeholder="ej: Sí">
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha_ficha" class="form-control">
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">💾 Guardar Matrícula</button>
    </div>
</form>
@endsection
