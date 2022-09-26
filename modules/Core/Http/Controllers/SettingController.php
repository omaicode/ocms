<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\Core\Facades\Email;
use Modules\Core\Http\Requests\Settings\UpdateBackend;
use Modules\Core\Http\Requests\Settings\UpdateAnalytics;
use Modules\Core\Http\Requests\Settings\UpdateEmail;
use Modules\Core\Http\Requests\Settings\UpdateMaintenance;
use Modules\Core\Supports\Config;
use Modules\Core\Supports\Helper;
use Modules\Core\Supports\Media;

class SettingController extends Controller
{
    public function general()
    {
        return view('core::general_settings');
    }

    public function email()
    {
        return view('core::email_settings');
    }

    public function updateBackend(UpdateBackend $request)
    {
        $data = $request->only([
            'app_language',
            'app_name',
            'app_debug',
            'app_timezone',
            'app_logo',
            'app_favicon'
        ]);
        
        if($request->hasFile('app_logo')) {
            $media = Media::upload($data['app_logo']);
            $data['app_logo'] = $media ? $media['save_path'] : null;
        } else {
            unset($data['app_logo']);
        }

        if($request->hasFile('app_favicon')) {
            $media = Media::upload($data['app_favicon']);
            $data['app_favicon'] = $media ? $media['save_path'] : null;
        } else {
            unset($data['app_favicon']);
        }

        $data['app_debug'] = @$data['app_debug'] == 'on' ? true : false;
        $data['app_cache'] = @$data['app_cache'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateAnalytics(UpdateAnalytics $request)
    {
        $data = $request->only([
            'app_analytics_trackingId',
            'app_analytics_viewId'
        ]);

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateMaintenance(UpdateMaintenance $request)
    {
        $data = $request->only([
            'app_maintenance',
        ]);

        $data['app_maintenance'] = @$data['app_maintenance'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function updateEmail(UpdateEmail $request)
    {
        $data = $request->input();
        $data['mail_queue'] = @$data['mail_queue'] == 'on' ? true : false;

        Config::set($data);

        return redirect()->back()->with('toast_success', __('core::messages.saved'));
    }

    public function getEmailTemplate(Request $request)
    {
        $template = Email::get($request->template);

        if(!$request->filled('template') || !$template) {
            return apiResponse(
                false,
                [],
                -1,
                __('core:messages.ajax_email_template_error')
            );
        }

        if($template['type'] == 'view') {
            $template['content'] = Helper::getRawView($template['content'])['content'];
        }

        return apiResponse(true, $template);
    }
}
