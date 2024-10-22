@extends('dashboard.layouts.app')

@section('title', '404 - الصفحة غير موجودة')

@section('content')
<div class="wrapper vh-100">
    <div class="align-items-center h-100 d-flex w-50 mx-auto">
      <div class="mx-auto text-center">
        <!-- Display the custom error code -->
        <h1 class="display-1 m-0 font-weight-bolder text-warning" style="font-size:80px;">404</h1>

        <!-- Main message -->
        <h1 class="mb-1 text-warning font-weight-bold">!خطأ 404 - الصفحة غير موجودة</h1>

        <!-- Explanation for the 4004 error -->
        <h6 class="mb-3 text-muted">الصفحة التي تبحث عنها غير موجودة أو تم نقلها.</h6>

        <!-- Button to redirect back to the dashboard -->
        <a href="{{ route('home') }}" class="btn btn-lg btn-primary px-5">العودة إلى لوحة التحكم</a>
      </div>
    </div>
</div>
@endsection
