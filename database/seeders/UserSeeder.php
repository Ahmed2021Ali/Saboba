<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
            // إنشاء المستخدم الأول مع صلاحيات ودور
            $user = User::create([
                'name' => 'mahmoudawaga',
                'email' => 'mahmoudawaga@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
                'phone' => '123456789999',
            ]);

            // إنشاء المستخدم الثاني بدون أي صلاحيات أو دور
            $user2 = User::create([
                'name' => 'ahmednaser',
                'email' => 'ahmednaser@gmail.com',
                'password' => Hash::make('password'),
                'type' => 'personal',
                'country_id' => 1,
                'phone' => '9876543211111',
            ]);

            // Create a new role


            // إنشاء دور "manager"
            $role = Role::create(['name' => 'manager']);
            $roleUser = Role::create(['name' => 'user']); // إنشاء دور للمستخدم
            $user2->assignRole($roleUser->id);

            // جلب جميع الصلاحيات
            $permissions = Permission::pluck('id', 'id')->all();

            // ربط كل الصلاحيات بدور "manager"
            $role->syncPermissions($permissions);

            // ربط دور "manager" بالمستخدم الأول
            $user->assignRole([$role->id]);

    }
}
