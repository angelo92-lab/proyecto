<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matriculas_2026', function (Blueprint $table) {
            $table->id();

            // Datos del estudiante
            $table->string('run')->unique();
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('nombres');
            $table->string('sexo');
            $table->date('fecha_nacimiento');
            $table->integer('edad_al_31_marzo');
            $table->string('nacionalidad');
            $table->string('direccion');
            $table->string('localidad');
            $table->string('comuna');
            $table->boolean('requiere_locomocion');
            $table->boolean('pueblos_originarios');
            $table->string('pueblo_originario')->nullable();
            $table->boolean('programa_integracion');
            $table->string('cursos_repetidos')->nullable();
            $table->string('establecimiento_procedencia')->nullable();
            $table->boolean('alergias')->default(false);
            $table->text('alergias_detalle')->nullable();
            $table->boolean('enfermedad_diagnosticada')->default(false);
            $table->text('enfermedad_detalle')->nullable();

            // Padres o tutores
            $table->string('padre_nombre')->nullable();
            $table->string('padre_nivel_educacional')->nullable();
            $table->string('madre_nombre')->nullable();
            $table->string('madre_nivel_educacional')->nullable();
            $table->string('tutor_nombre')->nullable();
            $table->string('tutor_nivel_educacional')->nullable();
            $table->text('personas_con_quien_vive')->nullable();

            // Vivienda
            $table->string('tipo_vivienda'); // propia, cedida, arrendada
            $table->boolean('posee_luz');
            $table->boolean('posee_alcantarillado');

            // Apoderado titular
            $table->string('apoderado_nombre');
            $table->string('apoderado_domicilio');
            $table->string('apoderado_telefono');

            // Apoderado suplente
            $table->string('suplente_nombre');
            $table->string('suplente_domicilio');
            $table->string('suplente_telefono');
            $table->boolean('autoriza_suplente');

            // Contacto emergencia
            $table->string('emergencia_nombre');
            $table->string('emergencia_celular');

            // Quien completa la ficha
            $table->string('responsable_ficha');
            $table->string('firma_responsable');
            $table->date('fecha_ficha');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
