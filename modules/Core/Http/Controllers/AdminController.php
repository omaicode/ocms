<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('core::dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }
}
