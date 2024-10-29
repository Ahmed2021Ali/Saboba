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


                    <div class="row my-4">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table datatables" id="dataTable-1">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th> اسم الموسسة</th>
                                            <th> تفاصيل الموسسة</th>

                                            <th> حالة الموسسة</th>
                                            <th> العمليات</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if($verifications->IsNotempty())

                                            <tr>
                                                @foreach ($verifications as $key => $verification)

                                                    <td>{{ ++$key }}</td>
                                                    <td> {{ $verification->user->name}}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_details_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i> تفاصيل الموسسة
                                                        </button>
                                                        @include('dashboard.identity_verification_company.details',['verification'=>$verification])
                                                    </td>
                                                    <td> {{ $verification->status ===1 ? " تم اثبات ملكية الحساب " : " لم يتم الاثبات الملكية حتي الان " }}</td>

                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i> عرض ملفات الاثبات
                                                        </button>
                                                        @include('dashboard.images.index', ['model' => $verification, 'folder' => 'documentationFiles'])

                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#delete_latest_news_{{$verification->id}}">
                                                            <i class="fa-solid fa-trash"></i> رفض اثبات الهوية
                                                        </button>
                                                    @include('dashboard.identity_verification_company.reject',['verification'=>$verification])
                                                @endforeach
                                            </tr>
                                        @else
                                            <h1 style="text-align: center"> لا يوجد شركات مثبته</h1>
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

