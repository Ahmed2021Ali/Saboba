<?php

namespace App\Http\Controllers;

use App\Models\CompanyIdentityVerification;
use Illuminate\Http\Request;

class IdentityVerificationController extends Controller
{
    public function index()
    {
        $verifications = CompanyIdentityVerification::where('status', 0)->get();
        return view('dashboard.identity_verification_company.index', compact('verifications'));
    }

    //public function update(CompanyIdentityVerification $verification)

    public function completed_identity_verification_companies()
    {
        $companies = CompanyIdentityVerification::where('status', 1)->get();

    }

    public function change_identity_verification_company()
    {


    }


}
