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

    <h4 class="mb-3 text-success">1️⃣ Datos del Estudiante</h4>

    

    <div class="row g-3">
        <div class="mb-3">
             <label for="curso" class="form-label">Curso al que se matricula</label>
            <input type="text" name="curso" id="curso" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="rut" class="form-label">RUT</label>
            <input type="text" name="rut" id="rut" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select name="sexo" id="sexo" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="edad_2026" class="form-label">Edad al 31 de Marzo 2026</label>
            <input type="number" name="edad_2026" id="edad_2026" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" name="nacionalidad" id="nacionalidad" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label for="direccion" class="form-label">Dirección (calle o lugar específico)</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="localidad" class="form-label">Localidad</label>
            <input type="text" name="localidad" id="localidad" class="form-control">
        </div>

        <div class="col-md-3">
            <label for="comuna" class="form-label">Comuna</label>
            <input type="text" name="comuna" id="comuna" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Requiere locomoción municipal?</label>
            <select name="locomocion_municipal" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Pertenece a pueblos originarios?</label>
            <select name="pueblos_originarios" class="form-select">
                <option value="">Seleccionar</option>
                <option value="No">No</option>
                <option value="Sí">Sí</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="pueblo_especifico" class="form-label">¿Cuál?</label>
            <input type="text" name="pueblo_especifico" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label">¿Pertenece a programa de integración?</label>
            <select name="programa_integracion" class="form-select">
                <option value="">Seleccionar</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-4">
            <label for="cursos_repetidos" class="form-label">Cursos que ha repetido</label>
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
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="enfermedades" class="form-label">¿Padece alguna enfermedad diagnosticada?</label>
            <input type="text" name="enfermedades" class="form-control">
        </div>
    </div>
    <h4 class="mt-4">Información del Padre, Madre y Tutor Legal</h4>

<div class="mb-3">
    <label for="padre_nombre" class="form-label">Nombre del Padre</label>
    <input type="text" class="form-control" name="padre_nombre" id="padre_nombre">
</div>
<div class="mb-3">
    <label for="padre_nivel_educacional" class="form-label">Nivel Educacional del Padre</label>
    <input type="text" class="form-control" name="padre_nivel_educacional" id="padre_nivel_educacional">
</div>
<div class="mb-3">
    <label for="madre_nombre" class="form-label">Nombre de la Madre</label>
    <input type="text" class="form-control" name="madre_nombre" id="madre_nombre">
</div>
<div class="mb-3">
    <label for="madre_nivel_educacional" class="form-label">Nivel Educacional de la Madre</label>
    <input type="text" class="form-control" name="madre_nivel_educacional" id="madre_nivel_educacional">
</div>
<div class="mb-3">
    <label for="tutor_nombre" class="form-label">Nombre del Tutor Legal</label>
    <input type="text" class="form-control" name="tutor_nombre" id="tutor_nombre">
</div>
<div class="mb-3">
    <label for="tutor_nivel_educacional" class="form-label">Nivel Educacional del Tutor Legal</label>
    <input type="text" class="form-control" name="tutor_nivel_educacional" id="tutor_nivel_educacional">
</div>
<div class="mb-3">
    <label for="personas_con_quien_vive" class="form-label">Personas con quien vive el estudiante</label>
    <textarea class="form-control" name="personas_con_quien_vive" id="personas_con_quien_vive" rows="3"></textarea>
</div>
<h4 class="mt-4">🏠 Información de la Vivienda</h4>

<div class="mb-3">
    <label for="tipo_vivienda" class="form-label">La vivienda es:</label>
    <select name="tipo_vivienda" id="tipo_vivienda" class="form-select">
        <option value="">Seleccione</option>
        <option value="propia">Propia</option>
        <option value="cedida">Cedida</option>
        <option value="arrendada">Arrendada</option>
    </select>
</div>

<div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" value="1" id="posee_luz" name="posee_luz">
    <label class="form-check-label" for="posee_luz">
        ¿Posee luz?
    </label>
</div>

<div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" value="1" id="posee_alcantarillado" name="posee_alcantarillado">
    <label class="form-check-label" for="posee_alcantarillado">
        ¿Posee alcantarillado?
    </label>
</div>
<h4 class="mt-4">👨‍👩‍👧 Información del Apoderado</h4>

<div class="mb-3">
    <label for="apoderado_nombre" class="form-label">Nombre y Apellidos del Apoderado Titular:</label>
    <input type="text" name="apoderado_nombre" id="apoderado_nombre" class="form-control">
</div>

<div class="mb-3">
    <label for="apoderado_domicilio" class="form-label">Domicilio:</label>
    <input type="text" name="apoderado_domicilio" id="apoderado_domicilio" class="form-control">
</div>

<div class="mb-4">
    <label for="apoderado_telefono" class="form-label">Teléfono:</label>
    <input type="text" name="apoderado_telefono" id="apoderado_telefono" class="form-control">
</div>

<h5>👥 Apoderado Suplente</h5>

<div class="mb-3">
    <label for="suplente_nombre" class="form-label">Nombre y Apellidos:</label>
    <input type="text" name="suplente_nombre" id="suplente_nombre" class="form-control">
</div>

<div class="mb-3">
    <label for="suplente_domicilio" class="form-label">Domicilio:</label>
    <input type="text" name="suplente_domicilio" id="suplente_domicilio" class="form-control">
</div>

<div class="mb-3">
    <label for="suplente_telefono" class="form-label">Teléfono:</label>
    <input type="text" name="suplente_telefono" id="suplente_telefono" class="form-control">
</div>

<div class="form-check mb-4">
    <input class="form-check-input" type="checkbox" value="1" id="autoriza_retiro_suplente" name="autoriza_retiro_suplente">
    <label class="form-check-label" for="autoriza_retiro_suplente">
        ¿Autoriza al apoderado suplente para retirar al estudiante?
    </label>
</div>
<h4 class="mt-4 mb-3 text-primary fw-bold">📞 Contacto de Emergencia</h4>

<div class="mb-3">
    <label for="emergencia_contacto_nombre" class="form-label">Nombre del Contacto</label>
    <input type="text" name="emergencia_contacto_nombre" class="form-control" value="{{ old('emergencia_contacto_nombre') }}">
</div>

<div class="mb-3">
    <label for="emergencia_contacto_celular" class="form-label">Celular</label>
    <input type="text" name="emergencia_contacto_celular" class="form-control" value="{{ old('emergencia_contacto_celular') }}">
</div>

<hr>

<h4 class="mt-4 mb-3 text-primary fw-bold">🖋️ Responsable de la Ficha</h4>

<div class="mb-3">
    <label for="responsable_ficha_nombre" class="form-label">Nombre de quien completa la ficha</label>
    <input type="text" name="responsable_ficha_nombre" class="form-control" value="{{ old('responsable_ficha_nombre') }}">
</div>

<div class="mb-3">
    <label for="responsable_ficha_firma" class="form-label">Firma (puedes poner "sí" por ahora)</label>
    <input type="text" name="responsable_ficha_firma" class="form-control" value="{{ old('responsable_ficha_firma') }}">
</div>

<div class="mb-3">
    <label for="responsable_ficha_fecha" class="form-label">Fecha de llenado</label>
    <input type="date" name="responsable_ficha_fecha" class="form-control" value="{{ old('responsable_ficha_fecha') }}">
</div>
<div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-success">💾 Guardar Matrícula</button>
    </div>

</form>
@endsection
