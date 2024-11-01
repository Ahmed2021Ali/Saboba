@extends('dashboard.layouts.master')

@section('title', ' العناوين الرائيسية ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title">{{ __('admin_dashboard/block_user/messages.Block users') }} </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="pull-right mb-2">
                        <br>
                        <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal"
                                data-target="#varyModal" data-whatever="@mdo">{{ __('admin_dashboard/block_user/messages.Add Block user') }}
                        </button>
                        @include('dashboard.blocked_user.create',['users'=>$users])
                    </div>
                    <div class="row my-4">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('admin_dashboard/block_user/messages.Blocked') }}</th>
                                            <th>{{ __('admin_dashboard/block_user/messages.Date Blocked') }}</th>
                                            <th>{{ __('admin_dashboard/block_user/messages.Blocked by') }}</th>
                                            <th> {{ __('admin_dashboard/block_user/messages.Reason for Block') }}</th>
                                            <th>{{ __('admin_dashboard/block_user/messages.Unblocking date') }}</th>
                                            <th>{{ __('admin_dashboard/block_user/messages.Unblock it by') }}</th>
                                            <th>{{ __('admin_dashboard/block_user/messages.operations') }}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($blockedUsers->isNotEmpty())
                                        @foreach ($blockedUsers as $key => $blockedUser)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $blockedUser->user->name }}</td>
                                                <td>{{ $blockedUser->blocked_at??null }}</td>
                                                <td>{{ $blockedUser->blockedBy->name }}</td>
                                                <td>{{ $blockedUser->reason }}</td>
                                                <td>{{ $blockedUser->unblocked_at/*->translatedFormat('l j F Y H:i:s')*/ }}</td>
                                                <td>{{ $blockedUser->unblockedBy->name/*->translatedFormat('l j F Y H:i:s')*/ }}</td>

                                                <td>
                                                    @if(!$blockedUser->unblocked_at)
                                                    <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                       data-target="#edit_blocked_user_{{$blockedUser->id}}"
                                                       data-whatever="@mdo"><i class="fa-solid fa-pen-to-square"></i>{{ __('admin_dashboard/block_user/messages.Unblock') }}</a>
                                                    @include('dashboard.blocked_user.edit',['blockedUser'=>$blockedUser,'users'=>$users])
                                                    @endif

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#delete_latest_news_{{$blockedUser->id}}"><i
                                                            class="fa-solid fa-trash"></i> {{ __('admin_dashboard/block_user/messages.delete') }}
                                                    </button>
                                                    @include('dashboard.blocked_user.delete',['latest_news'=>$blockedUser])


                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <h1 class="text-center"> {{ __('admin_dashboard/block_user/messages.There are no users in the block list.') }} </h1>
                                        @endif
                                        </tbody>
                                    </table>
                                    {{--
                                                                        {!! $subAddresses->links/*('pagination::bootstrap-5')*/ !!}
                                    --}}
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

@section('js')

@endsection
