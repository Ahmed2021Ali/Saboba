@extends('dashboard.layouts.master')

@section('title', 'تعديل الدور') <!-- Title in Arabic for "Edit Role" -->

@section('css')
  <!-- You can add specific CSS files for this page here -->
@endsection

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title"> تحديث دور {{ $role->name }}</h2> <!-- Page title in Arabic -->
                <div class="text-muted mb-4">
                    <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}">
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
                        <strong class="card-title">نموذج تعديل الدور</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $role->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="roleName"><strong>الاسم:</strong></label>
                                        <input type="text" name="name" id="roleName" placeholder="الاسم" class="form-control" value="{{ $role->name }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label><strong>الصلاحيات:</strong></label>
                                        <br />
                                        <div class="row">
                                            @foreach($permission as $index => $value)
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="form-check-input" id="permission{{$value->id}}" {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="permission{{$value->id}}">{{ $value->name }}</label>
                                                    </div>
                                                </div>
                                                @if (($index + 1) % 3 == 0)
                                                    </div><div class="row"> <!-- Start a new row after every three permissions -->
                                                @endif
                                            @endforeach
                                        </div>
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