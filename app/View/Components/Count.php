<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class Count extends Component
{
    public $contador;
    public $paginator;

    public function __construct($contador, LengthAwarePaginator $paginator)
    {
        $this->contador = $contador;
        $this->paginator = $paginator;
    }

    public function render(): View|Closure|string
    {
        return view('components.contador');
    }
}
