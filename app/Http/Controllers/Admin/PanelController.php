<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\HtmxResponse;

class PanelController extends Controller
{
    use HtmxResponse;

    public function home()
    {
        return $this->htmxView('admin.panel.dashboard.index');
    }

    public function manual()
    {
        return $this->htmxView('admin.panel.manual.index');
    }

    public function perfil()
    {
        return $this->htmxView('admin.panel.perfil.index', [
            'user' => Auth::user(),
        ]);
    }
}
