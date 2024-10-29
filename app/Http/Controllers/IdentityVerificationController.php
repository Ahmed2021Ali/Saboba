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
        $users_id = CompanyIdentityVerification::where('status', 1)->pluck('id');
        return view('dashboard.identity_verification_company.index', [
            'verifications' => $verifications,
            'companies' => User::where('type', 'company')->whereIn('id', '!=', $users_id)->get()]);
    }

    public function store(Request $request)
    {
        $validationData = $request->validate(['company_id' => 'nullable|exists:users,id']);
        $company = CompanyIdentityVerification::where('user_id', $validationData['company_id'])->first();
        if ($company) {
            if ($company->status == 1) {
                flash()->error('  تم اثبات ملكية هذ الموسسة من قبل  ');
                return redirect()->back();
            } else {
                flash()->success('  تم اثبات ملكية الموسسة بنجاح ');
                return redirect()->back();
            }
        }
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
        dd($verifications->pluck('id'));
        return view('dashboard.identity_verification_company.show', [
            'verifications' => $verifications,
            'companies' => User::where('type', 'company')->whereIn('id', '!=', $verifications->pluck('id'))->get()
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
