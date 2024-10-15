<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    /*  Show All Size  */
    public function index()
    {
        $languages = Auth::User()->userLanguages();
        return response()->json(LanguageResource::collection($languages));
    }

    /*  Store Size  */

/*    public function store(StoreSize $request)
    {
        $size = Size::create($request->validated());
        return response()->json(['message' => 'تم اضافة المقاس بنجاح',
            'size' => new SizeResource($size)
        ]);
    }

    public function update(UpdateSize $request, Size $size)
    {
        $size->update($request->validated());
        return response()->json(['message' => 'تم التحديث اسم المقاس بنجاح', 'size' => new SizeResource($size)
        ]);
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return response()->json(['message' => 'تم حذف المقاس بنجاح']);
    }*/
}
