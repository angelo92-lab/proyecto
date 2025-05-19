<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('notas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('alumno_id'); // de colegio20252
        $table->string('curso'); // ejemplo: "1Básico", "7°A", "3° Medio B"
        $table->string('asignatura'); // Matemáticas, Historia, etc.
        $table->integer('semestre'); // 1 o 2
        $table->decimal('nota', 5, 2); // nota final o promedio
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
