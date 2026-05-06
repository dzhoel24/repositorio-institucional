<?php

namespace App\View\Components;

use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $breadcrumbs;
    public $programa;

    public function __construct($name = 'home', $programa = null)
    {
        $this->breadcrumbs = Breadcrumbs::generate($name, $programa); // Ahora solo pasas el programa
        $this->programa = $programa; 
    }

    public function render()
    {
        return view('components.breadcrumb', [
            'programa' => $this->programa,
        ]);
    }
}

