@extends('dashboard.layouts.master')

@section('title','  اضافة مدينة جديد  ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <h2 class="mb-2 page-title text-center" style="text-align: center"> {{ __('admin_dashboard/city/messages.add') }}  {{$country->name}}  </h2>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="pull-right mb-2">
                        <br>
                        <button type="button" class="btn mb-2 btn-outline-secondary" data-toggle="modal"
                                data-target="#varyModal" data-whatever="@mdo">{{ __('admin_dashboard/city/messages.add') }}
                        </button>
                        @include('dashboard.city.create',['country'=>$country])
                    </div>

                    @if($cities->IsNotempty())

                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th> {{ __('admin_dashboard/city/messages.name') }}</th>
                                                <th> {{ __('admin_dashboard/city/messages.operation') }}</th>
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
                                                            {{ __('admin_dashboard/city/messages.edit') }}</a>
                                                        @include('dashboard.city.edit',['city'=>$city ,'country'=>$country])


                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#delete_latest_news_{{$city->id}}"><i
                                                                class="fa-solid fa-trash"></i> {{ __('admin_dashboard/city/messages.delete') }}
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
                        <h1 style="text-align: center"> {{ __('admin_dashboard/city/messages.no_cities_added') }} </h1>
                    @endif
                    <p class="text-center text-primary"><small>دليل من ItSolutionStuff.com</small></p>
                </div>
            </div>
        </div>
    </main>
@endsection

