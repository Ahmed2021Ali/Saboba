@extends('dashboard.layouts.master')

@section('title', ' العناوين الرائيسية ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title"> حظر المستخدمين </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="pull-right mb-2">
                        <br>
                        <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal"
                                data-target="#varyModal" data-whatever="@mdo">حظر مستخدم
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
                                            <th>الرقم</th>
                                            <th> تم حظر</th>
                                            <th> حظره بواسطة</th>
                                            <th> سبب الحظر</th>
                                            <th> فك الحظر</th>
                                            <th>تاريخ فك الحظر</th>
                                            <th>فك حظره بواسطة</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($blockedUsers as $key => $blockedUser)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $blockedUser->user->name }}</td>
                                                <td>{{ $blockedUser->blockedBy->name }}</td>
                                                <td>{{ $blockedUser->reason }}</td>
                                                <td>{{ $blockedUser->unlockedBy->name??null }}</td>
                                                <td>{{ $blockedUser->unblocked_at/*->translatedFormat('l j F Y H:i:s')*/ }}</td>
                                                <td>
                                                    @if(!$blockedUser->unblocked_at)
                                                    <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                       data-target="#edit_blocked_user_{{$blockedUser->id}}"
                                                       data-whatever="@mdo"><i class="fa-solid fa-pen-to-square"></i>قك
                                                        حظر </a>
                                                    @include('dashboard.blocked_user.edit',['blockedUser'=>$blockedUser,'users'=>$users])
                                                    @endif

                                                    <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#delete_latest_news_{{$blockedUser->id}}"><i
                                                            class="fa-solid fa-trash"></i> حذف
                                                    </button>
                                                    @include('dashboard.blocked_user.delete',['latest_news'=>$blockedUser])


                                                </td>
                                            </tr>
                                        @endforeach
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
