<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informe', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->longText('resumen');
            $table->unsignedSmallInteger('anio');
            $table->string('ruta_pdf', 250)->nullable();
            $table->string('ruta_caratula', 250)->nullable();
            $table->string('estado', 45)->nullable();
            $table->string('acceso', 45)->nullable();
            $table->string('modulo', 45)->nullable();
            $table->foreignId('tipo_informe_id')->constrained('tipo_informe')
                ->onDelete('cascade');
            $table->foreignId('carrera_id')
                ->nullable()
                ->constrained('carrera')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informe');
    }
};
