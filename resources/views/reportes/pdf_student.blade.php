<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Almuerzos por Alumno</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Almuerzos por Alumno</h1>
    <h2>Alumno: {{ $student->nombres }}</h2>
    <h3>Mes: {{ $month }}</h3>
    <h3>Cantidad de veces almorzó: {{ $count }}</h3>
</body>
</html>