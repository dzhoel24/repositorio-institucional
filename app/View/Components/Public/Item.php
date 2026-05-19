<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;

class Item extends Component
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
        $this->autores = $autores;
        $this->acceso = $acceso;
        $this->resumen = $resumen;
        $this->anio = $anio;
        $this->tipo = $tipo;
    }

    public function render()
    {
        return view('components.public.item');
    }
}
