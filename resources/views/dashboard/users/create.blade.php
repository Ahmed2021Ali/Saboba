@extends('dashboard.layouts.master')

@section('title', 'إنشاء مستخدم جديد') <!-- Title in Arabic for "Create New User" -->

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">إنشاء مستخدم جديد</h2> <!-- Page title in Arabic -->
                <div class="text-muted mb-4">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"></i> العودة
                    </a>
                </div>

                <!-- Display Errors -->
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

                <!-- User Form -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">نموذج المستخدم</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Name Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userName"><strong>الاسم:</strong></label>
                                        <input type="text" name="name" id="userName" placeholder="الاسم" class="form-control" value="{{ old('name') }}">
                                    </div>
                                </div>

                                <!-- Email Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userEmail"><strong>البريد الإلكتروني:</strong></label>
                                        <input type="email" name="email" id="userEmail" placeholder="البريد الإلكتروني" class="form-control" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <!-- Type Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="userMerchantSelect"><strong>اختر نوع المستخدم:</strong></label>
                                        <select name="type" id="userMerchantSelect" class="form-control">
                                            <option value="" disabled selected>اختر...</option>
                                            <option value="مستخدم">مستخدم</option>
                                            <option value="تاجر">تاجر</option>
                                            <option value="أدمن">أدمن</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Phone Number Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="phoneNumber"><strong>رقم الهاتف:</strong></label>
                                        <input type="text" name="phone_number" id="phoneNumber" placeholder="رقم الهاتف" class="form-control" value="{{ old('phone_number') }}">
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="password"><strong>كلمة المرور:</strong></label>
                                        <input type="password" name="password" id="password" placeholder="كلمة المرور" class="form-control">
                                    </div>
                                </div>

                                <!-- Confirm Password Input -->
                           <!-- Confirm Password Input -->
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation"><strong>تأكيد كلمة المرور:</strong></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور" class="form-control">
                                </div>
                            </div>


                            <!-- Role Selection -->
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="roles"><strong>الدور:</strong></label>
                                    <select name="role" id="roles" class="form-control">
                                        @foreach($roles as $role)
                                            @if($role !== 'manager') <!-- Exclude manager role -->
                                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endif
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

                                <!-- Submit Button -->
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
