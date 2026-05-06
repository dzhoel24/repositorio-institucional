<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autor_informe', function (Blueprint $table) {
            $table->string('autor_dni', 8);
            $table->foreign('autor_dni')
                ->references('dni')
                ->on('autores')
                ->onDelete('cascade');
            $table->foreignId('informe_id')
                ->constrained('informe')
                ->onDelete('cascade');
            $table->primary(['autor_dni', 'informe_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autor_informe');
    }
};
