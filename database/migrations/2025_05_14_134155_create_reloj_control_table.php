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
        Schema::create('reloj_control', function (Blueprint $table) {
    $table->id();
    $table->foreignId('funcionario_id')->constrained()->onDelete('cascade');
    $table->enum('tipo', ['entrada', 'salida']);
    $table->timestamp('created_at'); // la hora exacta de la marca
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reloj_control');
    }
};
