<?php

namespace App\View\Components;

use App\Models\Autor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    public $topAutors;

    public function __construct()
    {
        $this->topAutors = $this->getTopAuthors();
    }

    private function getTopAuthors(): array
    {
        return Autor::withCount(['informes' => function ($query) {
            $query->where('estado', 'Publicado');
        }])
            ->having('informes_count', '>', 0)
            ->orderByDesc('informes_count')
            ->take(10)
            ->get()
            ->map(fn($autor) => [
                'dni' => $autor->dni,
                'nombre' => $autor->nombres,
                'apellidos' => $autor->apellidos,
                'count' => $autor->informes_count,
            ])
            ->toArray();
    }

    public function render(): View|Closure|string
    {
        return view('components.filter');
    }
}
