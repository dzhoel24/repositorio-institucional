<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Informe;
use App\Models\Autor;

class InformeFactory extends Factory
{
    protected $model = Informe::class;

    public function definition()
    {
        static $i = 1;

        $nombrePdf = Str::uuid() . '.pdf';
        $nombreCaratula = Str::uuid() . '.jpg';

        $disk = Storage::disk('r2');

        // Sube los defaults a R2 si no existen aún
        if (!$disk->exists('default.pdf') && file_exists(public_path('default.pdf'))) {
            $disk->put('default.pdf', file_get_contents(public_path('default.pdf')));
        }

        if (!$disk->exists('default.jpg') && file_exists(public_path('default.jpg'))) {
            $disk->put('default.jpg', file_get_contents(public_path('default.jpg')));
        }

        // Copiar a pdfs/ y caratulas/
        if ($disk->exists('default.pdf')) {
            $disk->put('pdfs/' . $nombrePdf, $disk->get('default.pdf'));
        }

        if ($disk->exists('default.jpg')) {
            $disk->put('caratulas/' . $nombreCaratula, $disk->get('default.jpg'));
        }

        $currentYear = Carbon::now()->year;
        $years = range(2000, $currentYear);

        return [
            'id' => str_pad($i++, 5, '0', STR_PAD_LEFT),
            'titulo' => $this->faker->sentence(3),
            'resumen' => $this->faker->paragraph(3),
            'anio' => $this->faker->randomElement($years),
            'ruta_pdf' => $nombrePdf,
            'ruta_caratula' => $nombreCaratula,
            'estado' => $this->faker->randomElement(['Publicado', 'No Publicado']),
            'acceso' => $this->faker->randomElement(['Publico', 'Restringido']),
            'modulo' => $this->faker->randomElement(['I', 'II', 'III']),
            'tipo_informe_id' => rand(1, 4),
            'carrera_id' => rand(1, 8),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Informe $informe) {
            $autores = Autor::inRandomOrder()->take(rand(1, 3))->get();
            $informe->autores()->attach($autores->pluck('dni'));
        });
    }
}
