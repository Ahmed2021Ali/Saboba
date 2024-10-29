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

    public function update(Request $request, CompanyIdentityVerification $verification)
    {
        $verification->status = 1;
        $verification->save();
        flash()->success('  تم اثبات ملكية الموسسة بنجاح ');
        return redirect()->route('verifications.index');
    }

    public function destroy(Request $request, CompanyIdentityVerification $verification)
    {
        dd($request->reason);
        $verification->delete();
        flash()->success('  تم حذف اثبات ملكية الموسسة بنجاح ');
        return redirect()->route('verifications.index');
    }

}
