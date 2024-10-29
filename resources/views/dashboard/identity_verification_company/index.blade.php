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


                                                        <a class="btn btn-sm btn-danger" data-toggle="modal"
                                                           data-target="#reject_verification_{{$verification->id}}"
                                                           data-whatever="@mdo"><i class="fa-solid fa-trash"></i
                                                        @include('dashboard.identity_verification_company.reject',['verification'=>$verification])



                                                        <a class="btn btn-sm btn-success" data-toggle="modal"
                                                           data-target="#accept_verification_{{$verification->id}}"
                                                           data-whatever="@mdo"><i
                                                                class="fa-solid fa-pen-to-square"></i>
                                                            قبول اثبات الهوية </a>
                                                        @include('dashboard.identity_verification_company.accept',['verification'=>$verification])                                                    </td>

                                                    <td>

                                                        {{--
                                                                                                                <a class="btn btn-sm btn-info" href="{{ route('country.show', $country) }}">
                                                                                                                    <i class="fa-solid fa-list"></i>  عرض المدن لهذه الدولة
                                                                                                                </a>

                                                                                                               <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                                                                                   data-target="#edit_latest_news_{{$country->id}}"
                                                                                                                   data-whatever="@mdo"><i class="fa-solid fa-pen-to-square"></i>
                                                                                                                    تعديل</a>
                                                                                                                @include('dashboard.country.edit',['country'=>$country])


                                                                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                                                                        data-toggle="modal"
                                                                                                                        data-target="#delete_latest_news_{{$country->id}}"><i
                                                                                                                        class="fa-solid fa-trash"></i> حذف
                                                                                                                </button>
                                                                                                                @include('dashboard.country.delete',['country'=>$country,])

                                                        --}}

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

                    @else
                        <h1 style="text-align: center"> لا يوجد دول مضافة </h1>
                    @endif
                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div>
            </div>
        </div>
    </main>
@endsection

