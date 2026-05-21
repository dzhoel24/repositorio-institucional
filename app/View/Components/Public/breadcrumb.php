<?php

namespace App\View\Components\Public;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $breadcrumbs;

    public function __construct(
        public string $name = 'home',
        public array $params = []
    ) {
        $filteredParams = array_filter($this->params, fn($p) => $p !== null);
        $this->breadcrumbs = Breadcrumbs::generate(
            $this->name,
            ...array_values($filteredParams)
        );
    }

    public function render()
    {
        return view('components.public.breadcrumb');
    }
}
