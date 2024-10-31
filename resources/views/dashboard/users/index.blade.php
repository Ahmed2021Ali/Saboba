@extends('dashboard.layouts.master')
@section('title', 'إدارة المستخدمين')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">{{ __('admin_dashboard/users/messages.management_users') }}</h2>
                <div class="pull-right mb-2">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">
                        <i class="fa fa-plus"></i> {{ __('admin_dashboard/users/messages.add') }}
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
                                            <th></th>
                                            <th>{{ __('admin_dashboard/users/messages.name') }}</th>
                                            <th> {{ __('admin_dashboard/users/messages.email') }}</th>
                                            <th> {{ __('admin_dashboard/users/messages.country') }} </th>
                                            <th> {{ __('admin_dashboard/users/messages.phone_number') }}</th>
                                            <th>{{ __('admin_dashboard/users/messages.roles') }}</th>
                                            <th>{{ __('admin_dashboard/users/messages.operations') }}</th>
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
                                                <td>{{ $user->country->name }}</td>
                                                <td>{{ $user->phone }}</td>

                                                <td style="color: white">
                                                    @if($user->getRoleNames()->isNotEmpty())
                                                        @foreach($user->getRoleNames() as $v)
                                                            <label class="badge bg-warning">{{ $v }}</label>
                                                        @endforeach
                                                    @else
                                                        <label class="badge bg-success">مستخدم ابليكيشن</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#imageModal_{{ $user->id }}">
                                                        <i class="fa fa-edit"></i>   {{ __('admin_dashboard/users/messages.image') }}
                                                    </button>
                                                    @include('dashboard.images.index', ['model' => $user, 'folder' => 'userImages'])


                                                    <a class="btn btn-sm btn-info" href="{{ route('users.show', $user->id) }}">
                                                        <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/users/messages.show') }}
                                                    </a>

                                                        <a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user->id) }}">
                                                            <i class="fa-solid fa-pen-to-square"></i> {{ __('admin_dashboard/users/messages.edit') }}
                                                        </a>

                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}">
                                                            <i class="fa-solid fa-trash"></i> {{ __('admin_dashboard/users/messages.delete') }}
                                                        </button>
                                                    @include('dashboard.users.delete')
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">{{ __('admin_dashboard/users/messages.no_data') }}/td>
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
