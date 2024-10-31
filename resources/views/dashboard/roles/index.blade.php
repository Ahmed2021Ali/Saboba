@extends('dashboard.layouts.master')
@section('title', 'الأدوار')
@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">{{ __('admin_dashboard/roles/messages.manage_roles') }}</h2>
                @can('إضافة دور')
                <div class="pull-right mb-2">
                    <a class="btn btn-success btn-sm" href="{{ route('roles.create') }}">
                        <i class="fa fa-plus"></i> {{ __('admin_dashboard/roles/messages.add') }}
                    </a>
                </div>
                @endcan
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
                                            <th>#</th>
                                            <th>{{ __('admin_dashboard/roles/messages.name') }}</th>
                                            <th>{{ __('admin_dashboard/roles/messages.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($roles as $key => $role)
                                            @if ($role->name !== 'manager' || auth()->user()->hasRole('manager'))
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="role-{{ $role->id }}">
                                                            <label class="custom-control-label" for="role-{{ $role->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        @if ($role->name === 'manager')
                                                            @can('عرض دور')
                                                            <a class="btn btn-sm btn-primary" href="{{ route('roles.show', $role->id) }}">
                                                                <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/roles/messages.show') }}
                                                            </a>
                                                            @endcan
                                                        @else
                                                            @can('عرض دور')
                                                            <a class="btn btn-sm btn-primary" href="{{ route('roles.show', $role->id) }}">
                                                                <i class="fa-solid fa-list"></i> {{ __('admin_dashboard/roles/messages.show') }}
                                                            </a>
                                                            @endcan

                                                            @can('تعديل دور')
                                                            <a class="btn btn-sm btn-warning" href="{{ route('roles.edit', $role->id) }}">
                                                                <i class="fa-solid fa-pen-to-square"></i> {{ __('admin_dashboard/roles/messages.edit') }}
                                                            </a>
                                                            @endcan
                                                            @can('حذف دور')
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteRoleModal_{{ $role->id }}">
                                                                <i class="fa-solid fa-trash"></i> {{ __('admin_dashboard/roles/messages.delete') }}
                                                            </button>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>
                                                @include('dashboard.roles.delete')
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-danger">{{ __('admin_dashboard/users/messages.no_roles') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {!! $roles->links('pagination::bootstrap-5') !!}
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
