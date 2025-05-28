<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        // Datos del estudiante
        'run', 'apellido_paterno', 'apellido_materno', 'nombres', 'sexo', 'fecha_nacimiento',
        'edad_2026', 'nacionalidad', 'direccion', 'localidad', 'comuna', 'locomocion_municipal',
        'pertenece_pueblo_originario', 'pueblo_originario', 'programa_integracion',
        'cursos_repetidos', 'establecimiento_procedencia', 'alergias', 'enfermedades',

        // Información familiar
        'padre_nombre', 'padre_nivel_educacional', 'madre_nombre', 'madre_nivel_educacional',
        'tutor_nombre', 'tutor_nivel_educacional', 'personas_con_quien_vive', 'tipo_vivienda',
        'posee_luz', 'posee_alcantarillado',

        // Información del apoderado
        'apoderado_titular_nombre', 'apoderado_titular_domicilio', 'apoderado_titular_telefono',
        'apoderado_suplente_nombre', 'apoderado_suplente_domicilio', 'apoderado_suplente_telefono',
        'autoriza_suplente',

        // Información de emergencia
        'emergencia_nombre', 'emergencia_telefono',

        // Registro
        'responsable_ficha', 'firma_responsable', 'fecha_ficha',
    ];
}
