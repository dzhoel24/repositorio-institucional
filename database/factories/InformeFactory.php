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

    private static ?string $defaultPdf = null;
    private static ?string $defaultJpg = null;

    public function definition()
    {
        static $i = 1;

        $disk = Storage::disk('r2');

        if (self::$defaultPdf === null) {
            if (!$disk->exists('default.pdf') && file_exists(public_path('default.pdf'))) {
                $disk->put('default.pdf', file_get_contents(public_path('default.pdf')));
            }
            self::$defaultPdf = $disk->get('default.pdf');
        }

        if (self::$defaultJpg === null) {
            if (!$disk->exists('default.jpg') && file_exists(public_path('default.jpg'))) {
                $disk->put('default.jpg', file_get_contents(public_path('default.jpg')));
            }
            self::$defaultJpg = $disk->get('default.jpg');
        }

        $nombrePdf      = Str::uuid() . '.pdf';
        $nombreCaratula = Str::uuid() . '.jpg';

        $disk->put('pdfs/' . $nombrePdf, self::$defaultPdf);
        $disk->put('caratulas/' . $nombreCaratula, self::$defaultJpg);

        $currentYear = Carbon::now()->year;

        return [
            'id'              => str_pad($i++, 5, '0', STR_PAD_LEFT),
            'titulo'          => ucfirst($this->faker->bs()) . ': ' . $this->faker->catchPhrase(),
            'resumen'         => $this->faker->realText(400),
            'anio'            => $this->faker->numberBetween(2000, $currentYear),
            'ruta_pdf'        => $nombrePdf,
            'ruta_caratula'   => $nombreCaratula,
            'estado'          => $this->faker->randomElement(['Publicado', 'No Publicado']),
            'acceso'          => $this->faker->randomElement(['Publico', 'Restringido']),
            'modulo'          => $this->faker->randomElement(['I', 'II', 'III']),
            'tipo_informe_id' => rand(1, 4),
            'carrera_id'      => rand(1, 8),
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
