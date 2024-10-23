@extends('dashboard.layouts.app')

@section('title', '403 - تم رفض الوصول')

@section('content')
<div class="wrapper vh-100">
    <div class="align-items-center h-100 d-flex w-50 mx-auto">
      <div class="mx-auto text-center">
        <!-- Display the HTTP error code -->
        <h1 class="display-1 m-0 font-weight-bolder text-danger" style="font-size:80px;">403</h1>

        <!-- Main message -->
        <h1 class="mb-1 text-danger font-weight-bold">!تم رفض الوصول</h1>

        <!-- Explanation for the 403 error -->
        <h6 class="mb-3 text-muted">ليس لديك صلاحية للوصول إلى هذه الصفحة.</h6>

        <!-- Button to redirect back to the dashboard -->
        <a href="{{ route('home') }}" class="btn btn-lg btn-primary px-5">العودة إلى لوحة التحكم</a>
      </div>
    </div>
</div>
@endsection
