@extends('dashboard.layouts.app')

@section('title', '419 - انتهت صلاحية الصفحة')

@section('content')
<div class="wrapper vh-100">
    <div class="align-items-center h-100 d-flex w-50 mx-auto">
      <div class="mx-auto text-center">
        <!-- Display the error code -->
        <h1 class="display-1 m-0 font-weight-bolder text-warning" style="font-size:80px;">419</h1>

        <!-- Main message -->
        <h1 class="mb-1 text-warning font-weight-bold">انتهت صلاحية الصفحة!</h1>

        <!-- Explanation for the 419 error -->
        <h6 class="mb-3 text-muted">انتهت صلاحية الصفحة التي كنت تحاول الوصول إليها. يرجى إعادة المحاولة.</h6>

        <!-- Button to redirect back to the dashboard or refresh the page -->
        <a href="{{ route('home') }}" class="btn btn-lg btn-primary px-5">العودة إلى لوحة التحكم</a>
        <a href="javascript:location.reload()" class="btn btn-lg btn-secondary px-5">إعادة المحاولة</a>
      </div>
    </div>
</div>
@endsection
