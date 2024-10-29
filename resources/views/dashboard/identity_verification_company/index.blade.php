@extends('dashboard.layouts.master')

@section('title', '   اثبات هوية الموسسات قيد المراجهة ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title text-center" style="text-align: center"> اثبات هوية الموسسات قيد
                        المراجعة </h2>
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
                                                <th></th>
                                                <th> اسم الموسسة</th>
                                                <th> حالة الموسسة</th>
                                                <th> العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($verifications as $key => $verification)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td> {{ $verification->user->name}}</td>
                                                    <td> {{ $verification->status ===1 ? " تم اثبات ملكية الحساب " : " لم يتم الاثبات الملكية حتي الان " }}</td>

                                                    <td>
                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                                data-target="#imageModal_{{$verification->id}}">
                                                            <i class="fa fa-edit"></i> عرض ملفات الاثبات
                                                        </button>
                                                        @include('dashboard.images.index', ['model' => $verification, 'folder' => 'documentationFiles'])



                                                        <button class="btn btn-sm btn-success" data-toggle="modal"
                                                           data-target="#accept_verification_{{$verification->id}}"
                                                           data-whatever="@mdo" style="color: #000000"><i class="fa-solid fa-pen-to-square"></i>
                                                            قبول اثبات الهوية </button>
                                                        @include('dashboard.identity_verification_company.accept',['verification'=>$verification])                                                    </td>


                                                    <button type="button" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#delete_latest_news_{{$verification->id}}">
                                                        <i class="fa-solid fa-trash"></i> رفض اثبات الهوية
                                                    </button>
                                                    @include('dashboard.identity_verification_company.reject',['verification'=>$verification])

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
                        <h1 style="text-align: center"> لا يوجد دول مضافة </h1>
                    @endif
                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div>
            </div>
        </div>
    </main>
@endsection

