<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(10);
        return view('dashboard.users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('dashboard.users.create',compact('roles'));
    }


    public function store(UserRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

     //   $this->downloadImages($request->images, $user, 'userImages');

        // Assign the role(s) to the user
        $user->assignRole($validatedData['role']); // Use 'role' instead of 'roles'

        flash()->success('تم اضافة مستخدم بنجاح');

        return redirect()->route('users.index');
    }



    public function show($id): View
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.show', compact('user'));
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->first();


        return view('dashboard.users.edit', compact('user', 'roles', 'userRole', 'addresses'));
    }




    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
     //   $this->updateImages($request->images, $user, 'userImages');

        $validatedData = $request->validated();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        if (isset($validatedData['role'])) {
            $user->syncRoles($validatedData['role']);
        }

        flash()->success('تم تحديث المستخدم بنجاح');
        return redirect()->route('users.index');
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        flash()->success('تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }
}