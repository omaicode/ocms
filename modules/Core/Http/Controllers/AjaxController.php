<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Core\Facades\Email;
use Modules\Core\Http\Requests\Ajax\UpdateEmailTemplateRequest;
use Modules\Core\Supports\Helper;

class AjaxController extends Controller
{
    public function previewEmailTemplate(Request $request)
    {
        $view = $request->get('view');
        $content = '';

        if(View::exists($view)) {
            $raw = Helper::getRawView($view, false);
            $content = View::file($raw['full_path'])->render();
        }

        return apiResponse(true, [$content]);
    }

    public function updateEmailTemplate(UpdateEmailTemplateRequest $request)
    {
        Email::set($request->template, $request->content);

        return apiResponse(true);
    }

    public function clearCache()
    {
        Artisan::call("optimize:clear");

        return apiResponse(true);
    }
}
