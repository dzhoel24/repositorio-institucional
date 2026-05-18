<?php

namespace App\View\Components\Public;

use Illuminate\View\Component;

class Card extends Component
{
    public $codigo;
    public $image;
    public $title;
    public $autores;
    public $acceso;
    public $resumen;
    public $url;
    public $anio;  // 👈 Añadido para mostrar año en el card

    public function __construct($codigo, $image, $title, $autores, $acceso, $resumen, $anio = null, $parametro = 'institucional')
    {
        $this->codigo = $codigo;
        $this->image = $image;
        $this->title = $title;
        $this->autores = $autores;
        $this->acceso = $acceso;
        $this->resumen = $resumen;
        $this->anio = $anio;
        $this->url = route('repositorio.show', ['tipo' => $parametro, 'id' => $codigo]);
    }

    public function render()
    {
        return view('components.public.card');
    }
}
