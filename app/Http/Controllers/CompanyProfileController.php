<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyProfileResource;
use App\Http\Traits\media;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    use media;


    public function store(Request $request)
    {
        $validationData = $request->validate(['file' => 'required|max:10000']);
        $companyProfile = CompanyProfile::create();
        $companyProfile->addMedia($validationData['file'])->toMediaCollection('documentationFiles');
        return response()->json([
            'Data' => new CompanyProfileResource($companyProfile), 'success' => 'Documentation status under review'
        ], 201);
    }


}
