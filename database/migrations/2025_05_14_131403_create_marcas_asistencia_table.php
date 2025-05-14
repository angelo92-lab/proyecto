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
    Schema::create('marcas_asistencia', function (Blueprint $table) {
        $table->id();
        $table->foreignId('funcionario_id')->constrained('funcionarios')->onDelete('cascade');
        $table->enum('tipo', ['entrada', 'salida']);
        $table->timestamp('fecha_hora');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas_asistencia');
    }
};
