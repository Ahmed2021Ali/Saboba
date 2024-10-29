<?php

namespace App\Http\Controllers;

use App\Models\CompanyIdentityVerification;
use Illuminate\Http\Request;

class IdentityVerificationController extends Controller
{
    public function index()
    {
        $companies = CompanyIdentityVerification::where('status', 0)->get();
        return view('dashboard.identity_verification.index', compact('companies'));
    }

    public function completed_identity_verification_companies()
    {
        $companies = CompanyIdentityVerification::where('status', 1)->get();

    }

    public function change_identity_verification_company()
    {


    }


}
