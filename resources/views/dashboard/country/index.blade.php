@extends('dashboard.layouts.master')

@section('title', '  الدول ')

@section('css')

@endsection


@section('content')
    <main role="main" class="main-content">

        @if($countries->IsNotempty())
            <h1 class="text-center"> جميع الفئات </h1>
            <br>
            <div class="row">
                @foreach($countries as $country)
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow bg-primary text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">

{{--
                                        <a href="{{route('getNews',$country->id)}}">
--}}

                                      <span class="circle circle-sm bg-primary-light">
                                        <i class="fe fe-16 fe-shopping-bag text-white mb-0"></i>
                                      </span>

{{--
                                        </a>
--}}

                                    </div>

{{--
                                    <a href="{{route('getNews',$category->id)}}">
--}}

                                        <div class="col pr-0">
                                            <h4 class="text-light mb-0">{{$country->name}}</h4>
                                        </div>

{{--
                                    </a>
--}}

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @else
            <h1 style="text-align: center"> لا يوجد فئات </h1>
        @endif

    </main>
@endsection

