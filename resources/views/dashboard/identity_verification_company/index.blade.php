@extends('dashboard.layouts.master')

@section('title', '   اثبات هوية الموسسات قيد المراجهة ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title text-center" style="text-align: center"> {{ __('admin_dashboard/verification/messages.Proof_of_identity_of_the_institutions_under_review') }} </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($verifications->IsNotempty())

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('admin_dashboard/verification/messages.name') }} </th>
                                                <th> {{ __('admin_dashboard/verification/messages.details') }} </th>
                                                <th> {{ __('admin_dashboard/verification/messages.status') }} </th>
                                                <th> {{ __('admin_dashboard/verification/messages.operations') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($verifications as $key => $verification)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td> {{ $verification->user->name}}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_details_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i> {{ __('admin_dashboard/verification/messages.details') }}
                                                        </button>
                                                        @include('dashboard.identity_verification_company.details',['verification'=>$verification])
                                                    </td>
                                                    <td> {{ $verification->status ===1 ? " تم اثبات ملكية الحساب " : " لم يتم الاثبات الملكية حتي الان " }}</td>

                                                    <td>

                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i> {{ __('admin_dashboard/verification/messages.show_files') }}
                                                        </button>
                                                        @include('dashboard.images.index', ['model' => $verification, 'folder' => 'documentationFiles'])


                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#delete_latest_news_{{$verification->id}}">
                                                            <i class="fa-solid fa-trash"></i>{{ __('admin_dashboard/verification/messages.reject') }}
                                                        </button>
                                                        @include('dashboard.identity_verification_company.reject',['verification'=>$verification])



                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#accept_verification_{{$verification->id}}"
                                                                data-whatever="@mdo" style="color: #000000"><i class="fa-solid fa-pen-to-square"></i>
                                                            {{ __('admin_dashboard/verification/messages.accept') }} </button>
                                                        @include('dashboard.identity_verification_company.accept',['verification'=>$verification])                                                    </td>


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

                    @else
                        <h1 style="text-align: center">{{ __('admin_dashboard/verification/messages.There_are_no_companies_under_review') }} </h1>
                    @endif
                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div>
            </div>
        </div>
    </main>
@endsection

