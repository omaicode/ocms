<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Facades\AdminAsset;
use Modules\Core\Repositories\AdminActivityRepository;
use Modules\Core\Tables\ActivityTable;

class SystemController extends Controller
{
    public function information()
    {
        return view('core::pages.system.information');
    }

    public function activities(Request $request)
    {
        AdminAsset::addScript('table-builder', asset('vendor/table-builder/js/vue.min.js'));
        AdminAsset::addScript('table-builder', asset('vendor/table-builder/js/table-builder.js'));
        AdminAsset::addStyle('table-builder', asset('vendor/table-builder/css/table-builder.css'));

        $table = (new ActivityTable)->build($request);

        return view('core::pages.system.activities', compact('table'));
    }

    public function deleteActivity(Request $request, AdminActivityRepository $activity)
    {
        $rows = $request->get('rows', []);
        $activity->getModel()->whereIn('id', $rows)->delete();

        return apiResponse(true);
    }
}
