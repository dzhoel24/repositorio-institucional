<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $parametro;
    public $codigo;
    public $image;
    public $title;
    public $autores;
    public $acceso;
    public $resumen;
    public $action;

    public function __construct($codigo, $parametro = 'institucional', $image, $title, $autores, $acceso, $resumen, $action = 'show')
    {
        $this->parametro = $parametro;
        $this->codigo = $codigo;
        $this->image = $image;
        $this->title = $title;
        $this->autores = $this->formatAutores($autores);
        $this->acceso = $acceso;
        $this->resumen = $resumen;
        $this->action = $action;
    }

    private function formatAutores($autores)
    {
        return $autores->map(function ($autor) {
            return "{$autor->nombre} {$autor->apellidos}";
        })->implode(', ');
    }

    public function getIcon()
    {
        return match ($this->acceso) {
            'Publico' => 'lock-open',
            'Privado' => 'lock-closed',
            default => 'question-mark-circle',
        };
    }

    public function getColor()
    {
        return match ($this->acceso) {
            'Publico' => 'green',
            'Privado' => 'red',
            default => 'gray',
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.card', [
            'action' => $this->action,
            'generateRoute' => [$this, 'generateRoute'],
        ]);
    }
    public function generateRoute($parametro, $action, $codigo)
    {
        return match ($action) {
            'showInformeAutores' => route('filtros.showInformeAutores', ['informe' => $codigo]),
            'showFechaP' => route('filtros.showFechaP', ['id' => $codigo]),
            'show' => route('repositorio.show', ['tipo' => $parametro, 'id' => $codigo]),
            default => $parametro === 'home'
                ? route('home')
                : route('repositorio.index', ['tipo' => $parametro]),
        };
    }
}
