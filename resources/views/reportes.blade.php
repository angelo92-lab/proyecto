@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-5xl px-4 py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-primary mb-4 text-center">📊 Generador de Reportes de Almuerzos</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('reports.generate') }}" class="space-y-4">
            @csrf

            <div class="mb-3">
                <label for="report_type" class="form-label fw-semibold">Tipo de Reporte</label>
                <select name="report_type" id="report_type" class="form-select" required onchange="toggleReportForms()">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="course" {{ old('report_type') == 'course' ? 'selected' : '' }}>Por Curso</option>
                    <option value="student" {{ old('report_type') == 'student' ? 'selected' : '' }}>Por Alumno</option>
                </select>
            </div>

            {{-- Reporte por curso --}}
            <div id="course_form" style="display:none;">
                <div class="mb-3">
                    <label for="curso" class="form-label fw-semibold">Curso</label>
                    <select name="curso" id="curso" class="form-select">
                        <option value="" disabled selected>Seleccione curso</option>
                        @foreach($courses as $course)
                            <option value="{{ $course }}" {{ old('curso') == $course ? 'selected' : '' }}>{{ $course }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date_filter_type" class="form-label fw-semibold">Filtrar por</label>
                    <select name="date_filter_type" id="date_filter_type" class="form-select" onchange="toggleDateInput()">
                        <option value="day" {{ old('date_filter_type') == 'day' ? 'selected' : '' }}>Día</option>
                        <option value="month" {{ old('date_filter_type') == 'month' ? 'selected' : '' }}>Mes</option>
                    </select>
                </div>

                <div class="mb-3" id="date_day_div" style="display:none;">
                    <label for="date_day" class="form-label fw-semibold">Fecha (día)</label>
                    <input type="date" name="date" id="date_day" class="form-control" value="{{ old('date') }}">
                </div>

                <div class="mb-3" id="date_month_div" style="display:none;">
                    <label for="date_month" class="form-label fw-semibold">Fecha (mes)</label>
                    <input type="month" name="date" id="date_month" class="form-control" value="{{ old('date') }}">
                </div>
            </div>

            {{-- Reporte por alumno --}}
            <div id="student_form" style="display:none;">
                <div class="mb-3">
                    <label for="student_name" class="form-label fw-semibold">Nombre del Alumno</label>
                    <input type="text" name="student_name" id="student_name" class="form-control" value="{{ old('student_name') }}">
                </div>

                <div class="mb-3">
                    <label for="month" class="form-label fw-semibold">Mes</label>
                    <input type="month" name="month" id="month" class="form-control" value="{{ old('month') }}">
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-bar-chart-fill me-1"></i> Generar Reporte
                </button>
            </div>
        </form>
    </div>

    {{-- Resultados --}}
    @if(isset($reportData))
    <div class="mt-5 bg-white p-4 rounded shadow">
        <h3 class="text-lg fw-bold mb-3">📋 Resultados del Reporte</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>RUT</th>
                        <th>Dígito Verificador</th>
                        <th>Celular</th>
                        <th>Curso</th>
                        <th>Almorzó</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData as $data)
                    <tr>
                        <td>{{ $data['nombres'] }}</td>
                        <td>{{ $data['rut'] }}</td>
                        <td>{{ $data['digito_ver'] }}</td>
                        <td>{{ $data['celular'] }}</td>
                        <td>{{ $data['curso'] }}</td>
                        <td>{{ $data['almorzo'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex gap-2">
            <form method="POST" action="{{ route('reports.exportCsv') }}">
                @csrf
                <input type="hidden" name="report_type" value="course">
                <input type="hidden" name="curso" value="{{ $selectedCurso }}">
                <input type="hidden" name="date_filter_type" value="{{ $dateFilterType }}">
                <input type="hidden" name="date" value="{{ $selectedDate }}">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-file-earmark-spreadsheet me-1"></i> Exportar CSV
                </button>
            </form>

            <form method="POST" action="{{ route('reports.exportPdf') }}">
                @csrf
                <input type="hidden" name="report_type" value="course">
                <input type="hidden" name="curso" value="{{ $selectedCurso }}">
                <input type="hidden" name="date_filter_type" value="{{ $dateFilterType }}">
                <input type="hidden" name="date" value="{{ $selectedDate }}">
                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-file-earmark-pdf me-1"></i> Exportar PDF
                </button>
            </form>
        </div>
    </div>
    @endif
</div>

{{-- JavaScript --}}
<script>
    function toggleReportForms() {
        const reportType = document.getElementById('report_type').value;
        document.getElementById('course_form').style.display = reportType === 'course' ? 'block' : 'none';
        document.getElementById('student_form').style.display = reportType === 'student' ? 'block' : 'none';
    }

    function toggleDateInput() {
        const type = document.getElementById('date_filter_type').value;
        document.getElementById('date_day_div').style.display = type === 'day' ? 'block' : 'none';
        document.getElementById('date_month_div').style.display = type === 'month' ? 'block' : 'none';
        document.getElementById('date_day').disabled = type !== 'day';
        document.getElementById('date_month').disabled = type !== 'month';
    }

    document.addEventListener('DOMContentLoaded', () => {
        toggleReportForms();
        toggleDateInput();
    });
</script>
@endsection
