<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class item extends Component
{
    public $codigo;
    public $pdf;
    public $image;
    public $title;
    public $autores;
    public $acceso;
    public $resumen;
    public $anio;
    public $tipo;

    public function __construct($codigo, $pdf, $image, $title, $autores, $acceso, $resumen, $anio, $tipo)
    {
        $this->codigo = $codigo;
        $this->pdf = $pdf;
        $this->image = $image;
        $this->title = $title;
        $this->autores = $this->formatAutores($autores);
        $this->acceso = $acceso;
        $this->resumen = $resumen;
        $this->anio = $anio;
        $this->tipo = $tipo;
    }
    private function formatAutores($autores)
    {
        return $autores->map(function ($autor) {
            return "{$autor->nombre} {$autor->apellidos}";
        })->implode(', ');
    }

    public function render(): View|Closure|string
    {
        return view('components.item');
    }
}
