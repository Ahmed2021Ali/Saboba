@extends('dashboard.layouts.master')

@section('title', 'إنشاء مستخدم جديد') <!-- Title in Arabic for "Create New User" -->

@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="page-title">{{ __('admin_dashboard/users/messages.add') }}</h2> <!-- Page title in Arabic -->
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
                                            <label for="userName"><strong>{{ __('admin_dashboard/users/messages.name') }}:</strong></label>
                                            <input type="text" name="name" id="userName" placeholder="الاسم"
                                                   class="form-control" value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <!-- Email Input -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="userEmail"><strong>{{ __('admin_dashboard/users/messages.email') }}:</strong></label>
                                            <input type="email" name="email" id="userEmail"
                                                   placeholder="البريد الإلكتروني" class="form-control"
                                                   value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <!-- Phone Number Input -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="phone"><strong>{{ __('admin_dashboard/users/messages.phone_number') }} :</strong></label>
                                            <input type="text" name="phone" id="phone"
                                                   placeholder="رقم الهاتف" class="form-control"
                                                   value="{{ old('phone_number') }}">
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="password"><strong> {{ __('admin_dashboard/users/messages.password') }}:</strong></label>
                                            <input type="password" name="password" id="password"
                                                   placeholder="كلمة المرور" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Confirm Password Input -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="password_confirmation"><strong>{{ __('admin_dashboard/users/messages.password_confirmation') }}  :</strong></label>
                                            <input type="password" name="password_confirmation"
                                                   id="password_confirmation" placeholder="تأكيد كلمة المرور"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <!-- Country Selection -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="country_id"><strong> {{ __('admin_dashboard/users/messages.country') }}  :</strong></label>
                                            <select name="country_id" id="country_id" class="form-control" required>
                                                <option style="display: none"> {{ __('admin_dashboard/users/messages.select_country') }} </option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->id}}"> {{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Type Selection -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="type"><strong>{{ __('admin_dashboard/users/messages.type') }} :</strong></label>
                                            <select name="type" id="type" class="form-control">
                                                <option style="display: none"> {{ __('admin_dashboard/users/messages.select_type') }} </option>
                                                <option value="admin"> {{ __('admin_dashboard/users/messages.admin') }}</option>
                                                <option value="personal"> {{ __('admin_dashboard/users/messages.user') }}</option>
                                                <option value="company"> {{ __('admin_dashboard/users/messages.company') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Role Selection -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="roles"><strong>الدور:</strong></label>
                                            <select name="role" id="roles" class="form-control" required>
                                                <option style="display: none"> اختر دور المستخدم </option>
                                            @foreach($roles as $role)
                                                    @if($role !== 'manager')
                                                        <!-- Exclude manager role -->
                                                        <option
                                                            value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                                                            {{ $role }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Image Selection -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="files">الصور</label>
                                            <input type="file" name="images[]" id="files" class="form-control" multiple
                                                   accept="image/*" required>
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
