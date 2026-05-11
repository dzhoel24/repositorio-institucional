<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Informe;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $recientes = Informe::with(['autores', 'tipoInforme'])
            ->where('estado', 'Publicado')
            ->latest('created_at')
            ->take(10)
            ->get();

        return view('home', compact('recientes'));
    }
}
