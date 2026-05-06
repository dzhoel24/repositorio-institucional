<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Informe;

class InformeFactory extends Factory
{
    protected $model = Informe::class;

    public function definition()
    {
        static $i = 1;

        // 1. Generamos los nombres únicos para este registro
        $nombrePdf = Str::uuid() . '.pdf';
        $nombreCaratula = Str::uuid() . '.jpg';

        // 2. Rutas destino donde se guardarán las copias
        $rutaDestinoPdf = 'pdfs/' . $nombrePdf;
        $rutaDestinoCaratula = 'caratulas/' . $nombreCaratula;

        // Asegurarnos de que las carpetas destino existen
        Storage::disk('public')->makeDirectory('pdfs');
        Storage::disk('public')->makeDirectory('caratulas');

        // Verifica que el archivo base exista para evitar errores
        if (Storage::disk('public')->exists('default.pdf')) {
            Storage::disk('public')->copy('default.pdf', $rutaDestinoPdf);
        }

        if (Storage::disk('public')->exists('default.jpg')) {
            Storage::disk('public')->copy('default.jpg', $rutaDestinoCaratula);
        }

        return [
            'id' => str_pad($i++, 5, '0', STR_PAD_LEFT),
            'titulo' => $this->faker->sentence(3),
            'resumen' => $this->faker->paragraph(),
            'anio' => Carbon::now()->subYears(rand(1, 5))->year,

            // 4. Guardamos SOLO EL NOMBRE generado en la base de datos
            'ruta_pdf' => $nombrePdf,
            'ruta_caratula' => $nombreCaratula,

            'estado' => $this->faker->randomElement(['Publicado', 'No Publicado']),
            'acceso' => $this->faker->randomElement(['Publico', 'Restringido']),
            'modulo' => $this->faker->randomElement(['I', 'II', 'III']),
            'tipo_informe_id' => rand(1, 4),
            'carrera_id' => rand(1, 8),
        ];
    }
}
