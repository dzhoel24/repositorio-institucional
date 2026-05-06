<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class listTable extends Component
{
    public $autores;
    public function __construct($autores)
    {
        $this->autores = $autores;
    }

    public function render(): View|Closure|string
    {
        return view('components.list-table');
    }
}
