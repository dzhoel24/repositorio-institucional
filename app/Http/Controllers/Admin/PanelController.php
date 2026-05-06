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
        return $this->htmxView('admin.panel.home');
    }

    public function manual()
    {
        return $this->htmxView('admin.panel.manual');
    }

    public function perfil()
    {
        return $this->htmxView('admin.panel.perfil', [
            'user' => Auth::user(),
        ]);
    }
}
