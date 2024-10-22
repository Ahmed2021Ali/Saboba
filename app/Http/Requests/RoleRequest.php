<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|max:255|unique:roles,name,' . request()->id,
            'permission' => 'required|array',
            'permission.*' => 'integer|exists:permissions,id',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'اسم الدور مطلوب.',
            'name.unique' => 'اسم الدور موجود بالفعل.',
            'permission.required' => 'يجب تحديد الأذونات.',
            'permission.array' => 'الأذونات يجب أن تكون مصفوفة.',
            'permission.*.integer' => 'يجب أن تكون الأذونات أرقام صحيحة.',
            'permission.*.exists' => 'بعض الأذونات المحددة غير صحيحة.',
        ];
    }
}
