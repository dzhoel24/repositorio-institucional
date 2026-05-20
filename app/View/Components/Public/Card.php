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
    public $anio;
    public $action;
    public $origen;
    public $origenId;

    public function __construct(
        $codigo,
        $image,
        $title,
        $autores,
        $acceso,
        $resumen,
        $anio = null,
        $parametro = 'institucional',
        $action = 'show',
        $origen = null,
        $origenId = null,
        $url = null
    ) {
        $this->codigo = $codigo;
        $this->image = $image;
        $this->title = $title;
        $this->autores = $autores;
        $this->acceso = $acceso;
        $this->resumen = $resumen;
        $this->anio = $anio;
        $this->action = $action;
        $this->origen = $origen;
        $this->origenId = $origenId;

        if ($url) {
            $this->url = $url;
        } else {
            $this->url = match ($action) {
                'showInformeAutores' => route('public.filtros.autores.show', ['id' => $codigo]),
                'showFechaP' => route('public.filtros.fechas.show', ['id' => $codigo]),
                default => $this->buildUrl($parametro, $codigo, $origen, $origenId),
            };
        }
    }

    private function buildUrl($parametro, $codigo, $origen, $origenId): string
    {
        $params = ['tipo' => $parametro, 'id' => $codigo];

        if ($origen && $origenId) {
            $params['origen'] = $origen;
            $params['origenId'] = $origenId;
        } elseif ($origen) {
            $params['origen'] = $origen;
        }

        return route('repositorio.show', $params);
    }

    public function render()
    {
        return view('components.public.card');
    }
}
