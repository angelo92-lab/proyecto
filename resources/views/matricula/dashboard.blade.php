@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Dashboard de Matrículas</h1>

    <p><strong>Total de estudiantes matriculados:</strong> {{ $total }}</p>

    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="chartCurso"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="chartSexo"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <canvas id="chartComuna"></canvas>
        </div>
    </div>
    <div class="row mt-4">
    <div class="col-md-4">
        <div class="card p-3">
            <strong>🩺 Con alergias:</strong> {{ $conAlergias }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <strong>🧬 Con enfermedades diagnosticadas:</strong> {{ $conEnfermedades }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <strong>🚌 Requieren locomoción:</strong> {{ $requiereLocomocion }}
        </div>
    </div>
</div>
   <div class="col-md-6">
        <canvas id="chartVivienda"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="chartPueblos"></canvas>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <canvas id="chartProcedencia"></canvas>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const cursoData = {
        labels: {!! json_encode($porCurso->pluck('curso')) !!},
        datasets: [{
            label: 'Alumnos por curso',
            data: {!! json_encode($porCurso->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    };

    const sexoData = {
        labels: {!! json_encode($porSexo->pluck('sexo')) !!},
        datasets: [{
            label: 'Distribución por sexo',
            data: {!! json_encode($porSexo->pluck('total')) !!},
            backgroundColor: ['#FF6384', '#36A2EB']
        }]
    };

    const comunaData = {
        labels: {!! json_encode($porComuna->pluck('comuna')) !!},
        datasets: [{
            label: 'Alumnos por comuna',
            data: {!! json_encode($porComuna->pluck('total')) !!},
            backgroundColor: 'rgba(255, 206, 86, 0.7)'
        }]
    };

    new Chart(document.getElementById('chartCurso'), {
        type: 'bar',
        data: cursoData,
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    new Chart(document.getElementById('chartSexo'), {
        type: 'pie',
        data: sexoData,
        options: {
            responsive: true
        }
    });

    new Chart(document.getElementById('chartComuna'), {
        type: 'bar',
        data: comunaData,
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const viviendaData = {
    labels: {!! json_encode($porVivienda->pluck('tipo_vivienda')) !!},
    datasets: [{
        label: 'Tipo de vivienda',
        data: {!! json_encode($porVivienda->pluck('total')) !!},
        backgroundColor: 'rgba(153, 102, 255, 0.6)'
    }]
};

const pueblosData = {
    labels: {!! json_encode($pueblosOriginarios->pluck('pueblos_originarios')) !!},
    datasets: [{
        label: 'Pueblos originarios',
        data: {!! json_encode($pueblosOriginarios->pluck('total')) !!},
        backgroundColor: 'rgba(255, 159, 64, 0.6)'
    }]
};

const procedenciaData = {
    labels: {!! json_encode($procedencia->pluck('establecimiento_procedencia')) !!},
    datasets: [{
        label: 'Procedencia (top 10)',
        data: {!! json_encode($procedencia->pluck('total')) !!},
        backgroundColor: 'rgba(75, 192, 192, 0.6)'
    }]
};

new Chart(document.getElementById('chartVivienda'), {
    type: 'bar',
    data: viviendaData,
    options: { responsive: true }
});

new Chart(document.getElementById('chartPueblos'), {
    type: 'pie',
    data: pueblosData,
    options: { responsive: true }
});

new Chart(document.getElementById('chartProcedencia'), {
    type: 'bar',
    data: procedenciaData,
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } }
    }
});
</script>
@endsection
