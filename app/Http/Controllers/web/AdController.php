<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;
use App\Models\Category;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        return view('dashboard.ads.index', [
            'ads' => Ad::all(),
            'categories' => Category::with(['translations'])->where('parent_id', null)->get(),
        ]);
    }

    public function create(Request $request)
    {
        $validationData = $request->validate(['category_id' => 'required|exists:categories,id',]);
        if ($validationData['category_id'] == 1) {
            /*  أثاث المنزل	  */
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 2) {
            /*  عقارات */
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 3) {
            /* خدمات */
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 4) {
            /* سيارات ومركبات	 */
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 5) {
            /*  وظائف	 */
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 6) {
            /*   إعلانات مبوبة */
            return view('dashboard.ads.create');

        } else {
            flash()->success(' هذا القسم لا يوجد له اي اعلانات  ');
            return redirect()->back();
        }
    }

    public function show(Ad $ad)
    {
        return view('dashboard.ads.details_ads', ['ad' => $ad]);
    }

    public function notify_edit(Request $request, $ad)
    {
        dd($ad);
        // Request -> $request->reason
    }

    public function destroy(Request $request, Ad $ad)
    {
        // Notify User reason Reject
        // Request -> $request->reason

        $ad->delete();
        flash()->success('تم رفض هذا الاعلان   ');
        return redirect()->back();
    }
}
