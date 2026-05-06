<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdvancedFilter extends Component
{
    public string $defaultSort;
    public int $defaultItemsPerPage;
    public string $route;

    public function __construct(string $route, string $defaultSort = 'asc', int $defaultItemsPerPage = 10)
    {
        $this->defaultSort = $defaultSort;
        $this->defaultItemsPerPage = $defaultItemsPerPage;
        $this->route = $route;
    }

    public function render(): View|Closure|string
    {
        return view('components.advanced-filter', [
            'defaultSort' => $this->defaultSort,
            'defaultItemsPerPage' => $this->defaultItemsPerPage,
            'route' => $this->route,
        ]);
    }
}
