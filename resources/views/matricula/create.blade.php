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
            <input type="text" name="nombres" class="form-control">
        </div>
        <div class="form-group">
            <label>Apellido Paterno</label>
            <input type="text" name="apellido_paterno" class="form-control">
        </div>
        <div class="form-group">
            <label>Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control">
        </div>
        <div class="form-group">
            <label>RUN</label>
            <input type="text" name="run" class="form-control">
        </div>
        <div class="form-group">
            <label>Curso</label>
            <input type="text" name="curso" class="form-control">
        </div>

        <div class="form-group">
            <label>Edad</label>
            <input type="number" name="edad" class="form-control">
        </div>
        <div class="form-group">
            <label>Sexo</label>
            <select name="sexo" class="form-control">
                <option value="">Seleccione</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>

        <hr>

        {{-- INFORMACIÓN DE SALUD --}}
        <h4>Salud</h4>
        <div class="form-group">
            <label>¿Tiene enfermedades diagnosticadas?</label><br>
            <input type="checkbox" name="enfermedades[]" value="Asma"> Asma<br>
            <input type="checkbox" name="enfermedades[]" value="Diabetes"> Diabetes<br>
            <input type="checkbox" name="enfermedades[]" value="Otra"> Otra<br>
            <input type="text" name="otra_enfermedad" class="form-control mt-2" placeholder="Especifique si seleccionó otra">
        </div>

        <div class="form-group">
            <label>¿Tiene alergias?</label><br>
            <input type="checkbox" name="alergias[]" value="Polen"> Polen<br>
            <input type="checkbox" name="alergias[]" value="Alimentos"> Alimentos<br>
            <input type="checkbox" name="alergias[]" value="Medicamentos"> Medicamentos<br>
            <input type="checkbox" name="alergias[]" value="Otra"> Otra<br>
            <input type="text" name="otra_alergia" class="form-control mt-2" placeholder="Especifique si seleccionó otra">
        </div>

        <hr>

        {{-- VIVIENDA --}}
        <h4>Información de Vivienda</h4>
        <div class="form-group">
            <label>Tipo de Vivienda</label><br>
            <input type="radio" name="tipo_vivienda" value="Casa"> Casa<br>
            <input type="radio" name="tipo_vivienda" value="Departamento"> Departamento<br>
            <input type="radio" name="tipo_vivienda" value="Otro"> Otro<br>
            <input type="text" name="otro_tipo_vivienda" class="form-control mt-2" placeholder="Especifique si seleccionó otro">
        </div>
        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <hr>

        {{-- CONTACTOS DE EMERGENCIA --}}
        <h4>Contactos de Emergencia</h4>
        <div class="form-group">
            <label>Nombre Contacto 1</label>
            <input type="text" name="nombre_contacto1" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono Contacto 1</label>
            <input type="text" name="telefono_contacto1" class="form-control">
        </div>

        <div class="form-group">
            <label>Nombre Contacto 2</label>
            <input type="text" name="nombre_contacto2" class="form-control">
        </div>
        <div class="form-group">
            <label>Teléfono Contacto 2</label>
            <input type="text" name="telefono_contacto2" class="form-control">
        </div>

        <hr>

        {{-- RESPONSABLE DEL LLENADO --}}
        <h4>Responsable del Llenado</h4>
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="responsable_nombre" class="form-control">
        </div>
        <div class="form-group">
            <label>Fecha</label>
            <input type="date" name="fecha_llenado" class="form-control" value="{{ date('Y-m-d') }}">
        </div>

        <hr>

        <button type="submit" class="btn btn-primary">Guardar Matrícula</button>
    </form>
</div>
@endsection
