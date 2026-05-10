<?php

namespace App\Traits;

trait HtmxResponse
{
    protected function htmxView(string $view, array $data = [])
    {
        // Fallback para vistas con .index → admin.autores.index → admin.autores.show
        $htmxViewIndex = str_replace('.index', '.content', $view);

        if (isHtmx() && view()->exists($htmxViewIndex)) {
            return view($htmxViewIndex, $data);
        }

        return view($view, $data);
    }
}
