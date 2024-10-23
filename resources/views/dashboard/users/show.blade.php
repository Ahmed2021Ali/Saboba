@extends('dashboard.layouts.master')

@section('title', 'عرض المستخدم') <!-- Title in Arabic for "Show User" -->

@section('css')
@endsection

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">عرض المستخدم <span style="color: brown">{{ $user->name }}</h2> <!-- Page title in Arabic -->
                <div class="text-muted mb-4">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"></i> العودة
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">تفاصيل المستخدم</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الاسم:</strong>
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>البريد الإلكتروني:</strong>
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>رقم الهاتف:</strong>
                                    <p>{{ $user->phone }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>النوع:</strong>
                                    <p>{{ $user->type }}</p>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong> الدولة :</strong>
                                    <p>{{ $user->country }}</p> <!-- Assuming $user->address is an object with a 'name' property -->
                                </div>
                            </div>

                            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>كلمة المرور:</strong>
                                    <p>{{Crypt::decr ypt($user->password) }}</p> <!-- Display a masked password -->
                                </div>
                            </div> --}}

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>تاريخ الإنشاء:</strong>
                                    <p>{{ $user->created_at->timezone('Africa/Cairo')->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>تاريخ التحديث:</strong>
                                    <p>{{ $user->updated_at->timezone('Africa/Cairo')->format('Y-m-d H:i:s') }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الأدوار:</strong>
                                    <br />
                                    @if($user->getRoleNames()->isNotEmpty())
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @else
                                        <span class="text-muted">لا توجد أدوار</span> <!-- Message when no roles -->
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الصلاحيات:</strong>
                                    <br />
                                    @if($user->getAllPermissions()->isNotEmpty())
                                        @foreach($user->getAllPermissions() as $permission)
                                            <label class="badge badge-info">{{ $permission->name }}</label>
                                        @endforeach
                                    @else
                                        <span class="text-muted">لا توجد صلاحيات</span> <!-- Message when no permissions -->
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>صورة الملف الشخصي:</strong>
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="صورة المستخدم" class="img-thumbnail" style="max-width: 150px;">
                                    @else
                                        <span class="text-muted">لا توجد صورة</span>
                                    @endif
                                </div>
                            </div>
                        </div>
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
