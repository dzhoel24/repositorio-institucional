<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->string('dni', 8)->primary();
            $table->string('nombres', 50);
            $table->string('apellidos', 60);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autores');
    }
};
