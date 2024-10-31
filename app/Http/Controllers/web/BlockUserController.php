<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\BlockUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlockUserController extends Controller
{
    public function index()
    {
        return view('dashboard.blocked_user.index', [
            'blockedUsers' => BlockUser::paginate(8),
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['reason' => 'nullable|string', 'user_id' => 'required|exists:users,id',]);
        BlockUser::create([...$validated, 'blocked_by_user_id' => Auth::id(),'blocked_at'=>date('Y-m-d H:i:s')]);
        return redirect()->route('blocked_user.index')->with('success', 'تم اضافة الحظر بنجاح');
    }

    public function update(Request $request, BlockUser $blocked_user)
    {
        $blocked_user->update(['unlocked_by_user_id' => Auth::id(), 'unblocked_at' => now()]);
        return redirect()->route('blocked_user.index')->with('success', 'تم فك حظر المستخدم');
    }

    public function destroy(BlockUser $blocked_user)
    {
        $blocked_user->delete();
        return redirect()->route('blocked_user.index')->with('success', 'تم الحذف');
    }
}
