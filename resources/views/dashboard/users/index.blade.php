@extends('dashboard.layouts.master')
@section('title', 'إدارة المستخدمين')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">إدارة المستخدمين</h2>
                <div class="pull-right mb-2">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                        <i class="fa fa-plus"></i> إنشاء مستخدم جديد
                    </a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row my-4">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <table class="table datatables" id="dataTable-1">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>الرقم</th>
                                            <th>الاسم</th>
                                            <th>البريد الإلكتروني</th>
                                            <th> الدولة </th>
                                            <th> رقم الهاتف</th>
                                            <th>الأدوار</th>
                                            <th>الإجراء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $key => $user)

                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="user-{{ $user->id }}">
                                                        <label class="custom-control-label" for="user-{{ $user->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->country }}</td>
                                                <td>{{ $user->phone }}</td>

                                                <td style="color: white">
                                                    @if($user->getRoleNames()->isNotEmpty())
                                                        @foreach($user->getRoleNames() as $v)
                                                            <label class="badge bg-success">{{ $v }}</label>
                                                        @endforeach
                                                    @else
                                                        <label class="badge bg-danger">لا توجد أدوار</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#imageModal_{{ $user->id }}">
                                                        <i class="fa fa-edit"></i>  صور المستخدم
                                                    </button>
                                                    @include('dashboard.images.index', ['model' => $user, 'folder' => 'userImages'])


                                                    <a class="btn btn-sm btn-info" href="{{ route('users.show', $user->id) }}">
                                                        <i class="fa-solid fa-list"></i> عرض
                                                    </a>

                                                        <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user->id) }}">
                                                            <i class="fa-solid fa-pen-to-square"></i> تعديل
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">
                                                            <i class="fa-solid fa-trash"></i> حذف
                                                        </button>
                                                    @include('dashboard.users.delete')
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">لا توجد بيانات لعرضها.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {!! $data->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
            </div>
        </div>
    </div>
</main>
@endsection
