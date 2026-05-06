<?php

namespace App\Traits;

trait HtmxResponse
{
    protected function htmxView(string $view, array $data = [])
    {
        // Construye el nombre del show: panel.home → panel.home-show
        $htmxView = $view . '-show';

        if (isHtmx() && view()->exists($htmxView)) {
            return view($htmxView, $data);
        }

        // Fallback para vistas con .index → admin.autores.index → admin.autores.show
        $htmxViewIndex = str_replace('.index', '.show', $view);

        if (isHtmx() && view()->exists($htmxViewIndex)) {
            return view($htmxViewIndex, $data);
        }

        return view($view, $data);
    }
}
