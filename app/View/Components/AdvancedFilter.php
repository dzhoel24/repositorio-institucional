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
    public array $params;

    public function __construct(string $route, array $params = [], string $defaultSort = 'asc', int $defaultItemsPerPage = 10)
    {
        $this->defaultSort = $defaultSort;
        $this->defaultItemsPerPage = $defaultItemsPerPage;
        $this->route = $route;
        $this->params = $params;
    }

    public function render(): View|Closure|string
    {
        return view('components.public.advanced-filter', [
            'defaultSort' => $this->defaultSort,
            'defaultItemsPerPage' => $this->defaultItemsPerPage,
            'route' => $this->route,
            'params' => $this->params,
        ]);
    }
}
