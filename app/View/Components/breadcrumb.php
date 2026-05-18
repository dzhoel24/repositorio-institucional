<?php

namespace App\View\Components;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $breadcrumbs;

    public function __construct(
        public string $name = 'home',
        public array $params = []
    ) {
        $this->breadcrumbs = Breadcrumbs::generate(
            $this->name,
            ...$this->params
        );
    }

    public function render()
    {
        return view('components.breadcrumb');
    }
}
