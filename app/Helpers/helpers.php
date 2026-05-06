<?php

function isHtmx(): bool
{
    return request()->header('HX-Request') === 'true';
}
function htmxRedirect(string $route, string $message = null, string $type = 'success')
{
    if ($message) {
        session()->flash($type, $message);
    }

    if (isHtmx()) {
        return response()->noContent()
            ->header('HX-Redirect', $route);
    }

    return redirect($route)->with($type, $message);
}
