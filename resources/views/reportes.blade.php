@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-5xl">
    <h2 class="text-2xl font-semibold mb-6">Generador de Reportes de Almuerzos</h2>

    @if(session('error'))
    <div class="bg-red-100 text-red-900 p-3 mb-4 rounded">{{ session('error') }}</div>
    @endif

    {{-- Formulario para elegir tipo de reporte --}}
    <form method="POST" action="{{ route('reports.generate') }}" class="mb-6 space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-3">
            <label for="report_type" class="block font-medium mb-1">Tipo de Reporte:</label>
            <select name="report_type" id="report_type" class="border border-gray-300 rounded w-full p-2" required onchange="toggleReportForms()">
                <option value="" disabled selected>Seleccione...</option>
                <option value="course">Por Curso</option>
                <option value="student">Por Alumno</option>
            </select>
        </div>

        {{-- Formulario para reporte por curso --}}
        <div id="course_form" style="display:none;">
            <div class="mb-3">
                <label for="curso" class="block font-medium mb-1">Curso:</label>
                <select name="curso" id="curso" class="border border-gray-300 rounded w-full p-2">
                    <option value="" disabled selected>Seleccione curso</option>
                    @foreach($courses as $course)
                    <option value="{{ $course }}">{{ $course }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date_filter_type" class="block font-medium mb-1">Filtrar por:</label>
                <select name="date_filter_type" id="date_filter_type" class="border border-gray-300 rounded w-full p-2" onchange="toggleDateInput()">
                    <option value="day">Día</option>
                    <option value="month">Mes</option>
                </select>
            </div>

            <div class="mb-3" id="date_day_div" style="display:none;">
                <label for="date" class="block font-medium mb-1">Fecha (día):</label>
                <input type="date" name="date" id="date_day" class="border border-gray-300 rounded w-full p-2">
            </div>

            <div class="mb-3" id="date_month_div" style="display:none;">
                <label for="date_month" class="block font-medium mb-1">Fecha (mes):</label>
                <input type="month" name="date" id="date_month" class="border border-gray-300 rounded w-full p-2">
            </div>
        </div>

        {{-- Formulario para reporte por alumno --}}
        <div id="student_form" style="display:none;">
            <div class="mb-3">
                <label for="student_name" class="block font-medium mb-1">Nombre del Alumno:</label>
                <input type="text" name="student_name"
                id="student_name" class="border border-gray-300 rounded w-full p-2" required>
               </div>

               <div class="mb-3">
                   <label for="month" class="block font-medium mb-1">Mes:</label>
                   <input type="month" name="month" id="month" class="border border-gray-300 rounded w-full p-2" required>
               </div>
           </div>

           <button type="submit" class="bg-blue-500 text-white rounded p-2">Generar Reporte</button>
       </form>

       {{-- Opciones para exportar --}}
       @if(isset($reportData))
       <div class="mt-6">
           <h3 class="text-xl font-semibold">Resultados del Reporte</h3>
           <table class="min-w-full border border-gray-300 mt-4">
               <thead>
                   <tr>
                       <th class="border border-gray-300 p-2">Nombre</th>
                       <th class="border border-gray-300 p-2">RUT</th>
                       <th class="border border-gray-300 p-2">Dígito Verificador</th>
                       <th class="border border-gray-300 p-2">Celular</th>
                       <th class="border border-gray-300 p-2">Curso</th>
                       <th class="border border-gray-300 p-2">Almorzó</th>
                   </tr>
               </thead>
               <tbody>
    @foreach($reportData as $data)
    <tr>
        <td class="border border-gray-300 p-2">{{ $data['nombre'] }}</td>
        <td class="border border-gray-300 p-2">{{ $data['rut'] }}</td>
        <td class="border border-gray-300 p-2">{{ $data['digitoverificador'] }}</td>
        <td class="border border-gray-300 p-2">{{ $data['celular'] }}</td>
        <td class="border border-gray-300 p-2">{{ $data['curso'] }}</td>
        <td class="border border-gray-300 p-2">{{ $data['almorzo'] }}</td>
    </tr>
    @endforeach
</tbody>
>
           </table>

           <div class="mt-4">
               <form method="POST" action="{{ route('reports.exportCsv') }}">
                   @csrf
                   <input type="hidden" name="report_type" value="course">
                   <input type="hidden" name="curso" value="{{ $selectedCurso }}">
                   <input type="hidden" name="date_filter_type" value="{{ $dateFilterType }}">
                   <input type="hidden" name="date" value="{{ $selectedDate }}">
                   <button type="submit" class="bg-green-500 text-white rounded p-2">Exportar a CSV</button>
               </form>

               <form method="POST" action="{{ route('reports.exportPdf') }}" class="mt-2">
                   @csrf
                   <input type="hidden" name="report_type" value="course">
                   <input type="hidden" name="curso" value="{{ $selectedCurso }}">
                   <input type="hidden" name="date_filter_type" value="{{ $dateFilterType }}">
                   <input type="hidden" name="date" value="{{ $selectedDate }}">
                   <button type="submit" class="bg-red-500 text-white rounded p-2">Exportar a PDF</button>
               </form>
           </div>
       </div>
       @endif
   </div>

   <script>
    function toggleReportForms() {
        const reportType = document.getElementById('report_type').value;

        // Mostrar y habilitar según tipo
        const courseForm = document.getElementById('course_form');
        const studentForm = document.getElementById('student_form');

        courseForm.style.display = reportType === 'course' ? 'block' : 'none';
        studentForm.style.display = reportType === 'student' ? 'block' : 'none';

        // Habilita/deshabilita campos de curso
        [...courseForm.querySelectorAll('input, select')].forEach(el => {
            el.disabled = reportType !== 'course';
        });

        // Habilita/deshabilita campos de alumno
        [...studentForm.querySelectorAll('input, select')].forEach(el => {
            el.disabled = reportType !== 'student';
        });
    }

    function toggleDateInput() {
        const dateFilterType = document.getElementById('date_filter_type').value;
        const dayDiv = document.getElementById('date_day_div');
        const monthDiv = document.getElementById('date_month_div');

        dayDiv.style.display = dateFilterType === 'day' ? 'block' : 'none';
        monthDiv.style.display = dateFilterType === 'month' ? 'block' : 'none';

        // Habilita solo el campo que corresponde
        document.getElementById('date_day').disabled = dateFilterType !== 'day';
        document.getElementById('date_month').disabled = dateFilterType !== 'month';
    }

    // Ejecutar en carga si ya se envió algo
    document.addEventListener('DOMContentLoaded', () => {
        toggleReportForms();
        toggleDateInput();
    });
</script>

   @endsection  