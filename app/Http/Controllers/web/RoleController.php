<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    public function __construct()
    {
     //    $this->middleware('permission:عرض الأدوار', ['only' => ['index']]);

        //  Assign middleware directly in the constructor with the new permissions
        //    $this->middleware('permission:product|product2', ['only' => ['index', 'store']]);
        //     $this->middleware('permission:إضافة خبر|تعديل خبر', ['only' => ['create', 'store']]);
        //     $this->middleware('permission:حذف خبر|عرض الأخبار والتصنيفات', ['only' => ['edit', 'update']]);
        //    $this->middleware('permission:حذف خبر', ['only' => ['destroy']]);

    }


    public function index(Request $request): View
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $permission = Permission::get();
        return view('dashboard.roles.create', compact('permission'));
    }


    public function store(RoleRequest $request)
    {
        FacadesDB::transaction(function () use ($request) {
            $role = Role::create(['name' => $request->input('name')]);
            $permissionsID = array_map('intval', $request->input('permission'));
            $role->syncPermissions($permissionsID);
        });
        flash()->success('تم اضافة دور بنجاح');
        return redirect()->route('roles.index');
    }


    public function show($id): View
    {
        $role = Role::findOrFail($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('dashboard.roles.show', compact('role', 'rolePermissions'));
    }


    public function edit($id): View
    {
        $role = Role::findOrFail($id);
        $permission = Permission::get();
        $rolePermissions = FacadesDB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('dashboard.roles.edit', compact('role', 'permission', 'rolePermissions'));
    }


    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();
        $permissionsID = array_map('intval', $request->input('permission', []));
        $role->syncPermissions($permissionsID);

        flash()->success('تم تحديث الدور بنجاح.');

        return redirect()->route('roles.index');
    }


    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        flash()->success('تم حذف الدور بنجاح');

        return redirect()->route('roles.index');
    }

}
