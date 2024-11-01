<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyProfileResource;
use App\Models\CompanyIdentityVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyIdentityVerificationController extends Controller
{
    public function sendCompanyIdentifyVerification(Request $request)
    {
        if (auth()->user()->type === "company") {

            $identifyVerification = CompanyIdentityVerification::where('user_id', Auth()->id())->first();
            if (!$identifyVerification) {
                return $this->storeVerification($request);
            } elseif ($identifyVerification->status === 1) {
                return response()->json(['message' => 'Identity cannot be verified more than once - your account is already verified'], 500);
            } else {
                return response()->json(['message' => 'The documentation files have been sent and a response will be received within 3 to 5 business days. The documentation files cannot be sent again until a response is received.'], 500);
            }
        } else {
            return response()->json(['message' => 'Only the company or institution can document its identity'], 500);
        }
    }

    public function storeVerification($request)
    {
        DB::beginTransaction();
        try {
            $validationData = $request->validate(['file' => 'required|max:10000']);
            $companyProfile = CompanyIdentityVerification::create(['user_id' => Auth::id()]);
            $companyProfile->addMedia($validationData['file'])->toMediaCollection('documentationFiles');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()]);
        }
        return response()->json([
            'Data' => new CompanyProfileResource($companyProfile),
            'message' => 'Documentation status under review'
        ], 201);
    }


    public function statusCompanyIdentifyVerification()
    {
        $identifyVerification = CompanyIdentityVerification::where('user_id', Auth()->id())->first();
        if (!$identifyVerification) {
            //  Company Not Send files for Verifications
            return response()->json(['status' => "null", 'message' => 'No files have been sent for company identity verification.']);
        } elseif ($identifyVerification->status === 1) {
            //  your account is already verified
            return response()->json(['status' => "true", 'message' => 'Identity cannot be verified more than once - your account is already verified']);
        } else {
            // The documentation files have been sent -> Not replay Verify -> Witting Replay Verify
            return response()->json(['status' => "false", 'message' => 'The documentation files have been sent and a response will be received within 3 to 5 business days.']);
        }
    }
}
