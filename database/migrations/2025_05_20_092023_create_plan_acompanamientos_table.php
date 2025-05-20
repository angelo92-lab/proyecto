<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('plan_acompanamientos', function (Blueprint $table) {
    $table->id();
    $table->string('curso');
    $table->string('nombre');
    $table->string('procedencia')->nullable();
    $table->string('asignatura');
    $table->integer('asistencia')->nullable(); // puede ser porcentaje o cantidad
    $table->text('acompanamiento')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_acompanamientos');
    }
};
