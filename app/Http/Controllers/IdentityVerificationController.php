<?php

namespace App\Http\Controllers;

use App\Models\CompanyIdentityVerification;
use Illuminate\Http\Request;

class IdentityVerificationController extends Controller
{
    public function watting_identity_verification_companies()
    {
        $companies = CompanyIdentityVerification::where('status', 0)->get();

    }

    public function completed_identity_verification_companies()
    {
        $companies = CompanyIdentityVerification::where('status', 1)->get();

    }

    public function change_identity_verification_company()
    {


    }


}
