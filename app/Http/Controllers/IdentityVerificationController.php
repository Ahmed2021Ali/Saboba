<?php

namespace App\Http\Controllers;

use App\Models\CompanyIdentityVerification;
use App\Models\User;
use Illuminate\Http\Request;

class IdentityVerificationController extends Controller
{
    public function index()
    {
        $verifications = CompanyIdentityVerification::where('status', 0)->get();
        return view('dashboard.identity_verification_company.index', [
            'verifications' => $verifications,
            'companies' => User::where('type', 'company')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validationData = $request->validate(['company_id' => 'nullable|exists:users,id']);
        CompanyIdentityVerification::create(['user_id' => $validationData['company_id'], 'status' => 1]);
        flash()->success('  تم اثبات ملكية الموسسة بنجاح ');
        return redirect()->back();
    }

    public function update(Request $request, CompanyIdentityVerification $verification)
    {
        $verification->status = 1;
        $verification->save();
        flash()->success('  تم اثبات ملكية الموسسة بنجاح ');
        return redirect()->back();
    }

    public function show($id)
    {
        $verifications = CompanyIdentityVerification::where('status', 1)->get();
        return view('dashboard.identity_verification_company.show', [
            'verifications' => $verifications,
            'companies' => User::where('type', 'company')->get()
        ]);
    }

    public function destroy(Request $request, CompanyIdentityVerification $verification)
    {
        //dd($request->reason);
        // $request->reason
        $verification->delete();
        flash()->success('  تم حذف اثبات ملكية الموسسة بنجاح ');
        return redirect()->back();
    }

}
