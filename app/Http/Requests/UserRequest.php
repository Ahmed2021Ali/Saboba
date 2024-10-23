<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->input('id');
        return [
            'name' => 'required|string|max:50|min:2',
            'email' => 'required|email|max:50|min:5|unique:users,email,' . $id,
            'phone' => 'required|digits_between:10,15|unique:users,phone,' . $id,
            // Make password optional if not provided during update
            'password' => 'nullable|string|min:6|max:20|confirmed',
            'type' => 'required|in:company,admin,personal',
            'country_id' => 'nullable|integer|exists:countries,id',
            'role' => 'required|string|exists:roles,name',
            'images.*' => ['nullable', 'max:10000'],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'يرجى إدخال الاسم.',
            'name.string' => 'يجب أن يكون الاسم نصًا.',
            'name.max' => 'يجب ألا يزيد الاسم عن 50 حرفًا.',
            'name.min' => 'يجب أن يحتوي الاسم على الأقل على حرفين.',

            'email.required' => 'يرجى إدخال البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صالح.',
            'email.unique' => 'هذا البريد الإلكتروني موجود بالفعل.',
            'email.max' => 'يجب ألا يزيد البريد الإلكتروني عن 50 حرفًا.',
            'email.min' => 'يجب أن يحتوي البريد الإلكتروني على الأقل على 5 أحرف.',

            'phone_number.required' => 'يرجى إدخال رقم الهاتف.',
            'phone_number.numeric' => 'يجب أن يكون رقم الهاتف رقم.',
            'phone_number.max' => 'يجب ألا يزيد رقم الهاتف عن 15 حرفًا.',
            'phone_number.min' => 'يجب أن يحتوي رقم الهاتف على الأقل على 11 حرفًا.',
            'phone_number.unique' => 'هذا رقم الهاتف موجود بالفعل.',

            'password.required' => 'يرجى إدخال كلمة المرور.',
            'password.string' => 'يجب أن تكون كلمة المرور نصًا.',
            'password.min' => 'يجب أن تكون كلمة المرور على الأقل 6 أحرف.',
            'password.max' => 'يجب ألا تزيد كلمة المرور عن 20 حرفًا.',
            'password.confirmed' => 'يجب تأكيد كلمة المرور.',

            'type.required' => 'يرجى اختيار نوع المستخدم.',
            'type.in' => 'يجب أن يكون نوع المستخدم من بين: المستخدم، التاجر، الأدمن.',

            'address_id.required' => 'يرجى إدخال  العنوان.',

            'is_blocked.boolean' => 'يجب أن تكون القيمة صحيحة أو خاطئة.',

            'role.required' => 'يرجى تحديد دور المستخدم.',
            'role.string' => 'يجب أن يكون الدور نصًا.',
            'role.max' => 'يجب ألا يزيد دور المستخدم عن 50 حرفًا.',
            'role.min' => 'يجب أن يحتوي دور المستخدم على الأقل على حرفين.',
        ];
    }
}
