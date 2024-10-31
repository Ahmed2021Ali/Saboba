@extends('dashboard.layouts.master')

@section('title', '   اثبات هوية الموسسات قيد المراجهة ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title text-center" style="text-align: center"> موسسات تمت اثبات هويتها
                        بنجاح </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="pull-right mb-2">
                        <br>
                        <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal"
                                data-target="#varyModal" data-whatever="@mdo">{{ __('admin_dashboard/verification/messages.verify_identity') }}
                        </button>
                        @include('dashboard.identity_verification_company.create',['companies'=>$companies])
                    </div>
                    <div class="row my-4">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th> {{ __('admin_dashboard/verification/messages.name') }}</th>
                                            <th>  {{ __('admin_dashboard/verification/messages.details') }}</th>

                                            <th> {{ __('admin_dashboard/verification/messages.status') }}</th>
                                            <th> {{ __('admin_dashboard/verification/messages.operations') }}</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if($verifications->IsNotempty())
                                            @foreach ($verifications as $key => $verification)

                                            <tr>

                                                    <td>{{ ++$key }}</td>
                                                    <td> {{ $verification->user->name}}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_details_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i>{{ __('admin_dashboard/verification/messages.details') }}
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
                                                            <i class="fa-solid fa-trash"></i> {{ __('admin_dashboard/verification/messages.reject') }}
                                                        </button>
                                                    @include('dashboard.identity_verification_company.reject',['verification'=>$verification])
                                            </tr>
                                            @endforeach

                                        @else
                                            <h1 style="text-align: center">{{ __('admin_dashboard/verification/messages.There_are_no_companies_verified') }}</h1>
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

