<?php

namespace App\View\Components;

use App\Models\Autor; 
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    public array $yearRanges;
    public $topAutors;

    public function __construct()
    {
        $currentYear = date('Y');
        $this->yearRanges = $this->generateYearRanges($currentYear);
        $this->topAutors = $this->getTopAuthors(); 
    }

    private function generateYearRanges(int $currentYear): array
    {
        $ranges = [];
        $startYear = 2000;

        while ($startYear <= $currentYear) {
            $endYear = min($startYear + 4, $currentYear);
            $ranges[] = "{$startYear}-{$endYear}";
            $startYear += 5;
        }

        return array_reverse($ranges);
    }

    private function getTopAuthors(): array
    {
        return Autor::withCount('informes')
            ->orderByDesc('informes_count')
            ->take(10)
            ->get()
            ->map(fn ($autor) => [
                'dni' => $autor->dni,
                'nombre' => $autor->nombre,
                'apellidos'=> $autor->apellidos,
                'count' => $autor->informes_count,
            ])
            ->toArray();
    }
    public function render(): View|Closure|string
    {
        return view('components.filter');
    }

    
}
