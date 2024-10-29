@extends('dashboard.layouts.master')

@section('title', '  الدول ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title text-center" style="text-align: center"> اثبات هوية الشركات</h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($companies->IsNotempty())

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

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($companies as $key => $company)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td> {{ $company->user->name}}</td>
                                                    <td> {{ $company->status ===1 ? " تم اثبات ملكية الحساب " : " لم يتم الاثبات الملكية حتي الان " }}</td>



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

