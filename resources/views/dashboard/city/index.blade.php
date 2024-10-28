@extends('dashboard.layouts.master')

@section('title', '  مدينة ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title"> اضافة مدينة جديد</h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="pull-right mb-2">
                        <br>
                        <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal"
                                data-target="#varyModal" data-whatever="@mdo">اضافة مدينة جديد
                        </button>
                        @include('dashboard.city.create')
                    </div>

                    @if($cities->IsNotempty())

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th> اسم المدينة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($cities as $key => $city)
                                                <tr>
                                                    <td>{{ ++$key }}</td>

                                                    <td> {{ $city->name }}</td>
                                                    <td>


                                                        <a class="btn btn-sm btn-warning" data-toggle="modal"
                                                           data-target="#edit_latest_news_{{$city->id}}"
                                                           data-whatever="@mdo"><i
                                                                class="fa-solid fa-pen-to-square"></i>
                                                            تعديل</a>
                                                        @include('dashboard.city.edit',['city'=>$city])


                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#delete_latest_news_{{$city->id}}"><i
                                                                class="fa-solid fa-trash"></i> حذف
                                                        </button>
                                                        @include('dashboard.city.delete',['city'=>$city,])


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

