@extends('dashboard.layouts.master')

@section('title', 'عرض الدور') <!-- Title in Arabic for "Show Role" -->

@section('css')
  <!-- You can add specific CSS files for this page here -->
@endsection

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">عرض الدور</h2> <!-- Page title in Arabic -->
                <div class="text-muted mb-4">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}">
                        <i class="fa fa-arrow-left"></i> العودة
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">تفاصيل الدور</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>الاسم:</strong>
                                    <p>{{ $role->name }}</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label><strong>الصلاحيات:</strong></label>
                                            <br />
                                            <div class="row">
                                                @if(!empty($rolePermissions) && count($rolePermissions) > 0)
                                                    @foreach($rolePermissions as $index => $permission)
                                                        <div class="col-md-4 mb-3">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="permission{{$permission->id}}" disabled checked>
                                                                <label class="form-check-label" for="permission{{$permission->id}}">{{ $permission->name }}</label>
                                                            </div>
                                                        </div>
                                                        @if (($index + 1) % 3 == 0 && $index != count($rolePermissions) - 1)
                                                            </div><div class="row"> <!-- Start a new row after every three permissions, but not after the last -->
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">لا توجد صلاحيات</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
