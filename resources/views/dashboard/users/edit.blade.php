@extends('dashboard.layouts.master')

@section('title', 'تعديل المستخدم') <!-- Title in Arabic for "Edit User" -->

@section('css')
  <!-- You can add specific CSS files for this page here -->
@endsection

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">تعديل المستخدم <span style="color: brown">{{ $user->name }}</span></h2> <!-- Page title in Arabic -->
                <div class="text-muted mb-4">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"></i> العودة
                    </a>
                </div>

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>عذرًا!</strong> كانت هناك بعض المشاكل في إدخال بياناتك.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">نموذج تعديل المستخدم</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userName"><strong>الاسم:</strong></label>
                                        <input type="text" name="name" id="userName" placeholder="الاسم" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userEmail"><strong>البريد الإلكتروني:</strong></label>
                                        <input type="email" name="email" id="userEmail" placeholder="البريد الإلكتروني" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phoneNumber"><strong>رقم الهاتف:</strong></label>
                                        <input type="text" name="phone_number" id="phoneNumber" placeholder="رقم الهاتف" class="form-control" value="{{ $user->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="newPassword"><strong>كلمة المرور الجديدة:</strong></label>
                                        <input type="password" name="password" id="newPassword" placeholder="كلمة المرور الجديدة" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">

                                <div class="form-group mb-3">
                                    <label for="confirmPassword"><strong>تأكيد كلمة المرور الجديدة:</strong></label>
                                    <input type="password" name="password_confirmation" id="confirmPassword" placeholder="تأكيد كلمة المرور" class="form-control">
                                </div>
                                </div>

                                <!-- Type Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userMerchantSelect"><strong>اختر نوع المستخدم:</strong></label>
                                        <select name="type" id="userMerchantSelect" class="form-control">
                                            <option value="" disabled {{ old('type', $user->type) === null ? 'selected' : '' }}>اختر نوع المستخدم...</option>
                                            <option value="أدمن" {{ old('type', $user->type) === 'أدمن' ? 'selected' : '' }}>أدمن</option>
                                            <option value="تاجر" {{ old('type', $user->type) === 'تاجر' ? 'selected' : '' }}>تاجر</option>
                                            <option value="مستخدم" {{ old('type', $user->type) === 'مستخدم' ? 'selected' : '' }}>مستخدم</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Role Selection -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="roles"><strong>الدور:</strong></label>
                                        <select name="role" id="roles" class="form-control">
                                            @foreach($roles as $role)
                                                <option value="{{ $role }}" {{ (string)old('role', $userRole) === (string)$role ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <!-- Address Selection (Optional) -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="address_id"><strong>العنوان </strong></label>
                                        <select name="address_id" id="address_id" class="form-control">
                                            <option value="">اختر عنوان</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}" {{ old('address_id', $user->address_id) == $address->id ? 'selected' : '' }}>
                                                    {{ $address->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="files">الصور</label>
                                        <input type="file" name="images[]" id="files" class="form-control" multiple accept="image/*" required>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-sm mb-3">
                                        <i class="fa-solid fa-floppy-disk"></i> تأكيد
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- / .card -->
                <p class="text-center text-primary"><small>دليل بواسطة ItSolutionStuff.com</small></p>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</main>
@endsection

@section('js')
  <!-- You can add specific JavaScript files for this page here -->
@endsection
